/**
 * Homepage Custom Fields - Admin JavaScript
 */
(function($) {
    'use strict';

    var mediaFrame;
    var currentUploadTarget = null;
    var currentImageRow = null;

    $(document).ready(function() {
        initImageUpload();
        initRemoveImage();
        initGallerySectionRepeater();
        initImageRowRepeater();
        updateSectionNumbers();
    });

    function initImageUpload() {
        $(document).on('click', '.ig-upload-image', function(e) {
            e.preventDefault();
            currentUploadTarget = $(this).data('target');
            currentImageRow = null;
            openMediaFrame();
        });

        $(document).on('click', '.ig-upload-image-small', function(e) {
            e.preventDefault();
            currentUploadTarget = null;
            currentImageRow = $(this).closest('.ig-image-row');
            openMediaFrame();
        });
    }

    function openMediaFrame() {
        if (mediaFrame) {
            mediaFrame.open();
            return;
        }

        mediaFrame = wp.media({
            title: 'Select or Upload Image',
            button: { text: 'Use this image' },
            library: { type: 'image' },
            multiple: false
        });

        mediaFrame.on('select', function() {
            var attachment = mediaFrame.state().get('selection').first().toJSON();
            var url = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
            var previewUrl = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;

            if (currentUploadTarget) {
                var $wrap = $('.ig-image-upload-wrap[data-target="' + currentUploadTarget + '"]');
                $('#' + currentUploadTarget).val(attachment.id);
                $wrap.find('.ig-image-preview').html('<img src="' + url + '" alt="">');
                $wrap.find('.ig-add-media-wrap').hide();
                $wrap.find('.ig-image-preview-wrap').show();
            } else if (currentImageRow && currentImageRow.length) {
                currentImageRow.find('.ig-image-id').val(attachment.id);
                currentImageRow.find('.ig-image-preview-small').html('<img src="' + previewUrl + '" alt="">');
                currentImageRow.find('.ig-add-media-wrap').hide();
                currentImageRow.find('.ig-image-preview-wrap').show();
            }
        });

        mediaFrame.open();
    }

    function initRemoveImage() {
        $(document).on('click', '.ig-delete-image', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            var $wrap = $('.ig-image-upload-wrap[data-target="' + target + '"]');
            $('#' + target).val('');
            $wrap.find('.ig-image-preview').empty();
            $wrap.find('.ig-image-preview-wrap').hide();
            $wrap.find('.ig-add-media-wrap').show();
        });

        $(document).on('click', '.ig-delete-image-small', function(e) {
            e.preventDefault();
            var $row = $(this).closest('.ig-image-row');
            $row.find('.ig-image-id').val('');
            $row.find('.ig-image-preview-small').empty();
            $row.find('.ig-image-preview-wrap').hide();
            $row.find('.ig-add-media-wrap').show();
        });

        $(document).on('click', '.ig-edit-image', function(e) {
            e.preventDefault();
            currentUploadTarget = $(this).data('target');
            currentImageRow = null;
            openMediaFrame();
        });

        $(document).on('click', '.ig-edit-image-small', function(e) {
            e.preventDefault();
            currentUploadTarget = null;
            currentImageRow = $(this).closest('.ig-image-row');
            openMediaFrame();
        });
    }

    function initGallerySectionRepeater() {
        $('#ig_add_gallery_section').on('click', function() {
            var $wrap = $('#ig_gallery_sections_wrap');
            var nextIndex = $wrap.find('.ig-gallery-section-row').length;
            var html = (typeof igHomepageFields !== 'undefined' && igHomepageFields.gallerySectionTemplate)
                ? igHomepageFields.gallerySectionTemplate.replace(/__INDEX__/g, nextIndex)
                : '';
            if (html) {
                $wrap.append(html);
                updateSectionNumbers();
                initEditorForSection(nextIndex);
            }
        });

        $(document).on('click', '.ig-remove-section', function() {
            $(this).closest('.ig-gallery-section-row').remove();
            reindexGallerySections();
            updateSectionNumbers();
        });
    }

    function initImageRowRepeater() {
        $(document).on('click', '.ig-add-image', function() {
            var $repeater = $(this).closest('.ig-images-repeater');
            var sectionIndex = $(this).closest('.ig-gallery-section-row').data('index');
            var $list = $repeater.find('.ig-images-list');
            var nextImgIndex = $list.find('.ig-image-row').length;

            var template = (typeof igHomepageFields !== 'undefined' && igHomepageFields.imageRowTemplate)
                ? igHomepageFields.imageRowTemplate
                : '';
            if (!template) return;

            var html = template
                .replace(/__SECTION_INDEX__/g, sectionIndex)
                .replace(/__IMG_INDEX__/g, nextImgIndex);
            $list.append(html);
        });

        $(document).on('click', '.ig-remove-image-row', function() {
            var $list = $(this).closest('.ig-images-list');
            $(this).closest('.ig-image-row').remove();
            if ($list.find('.ig-image-row').length === 0) {
                var sectionIndex = $list.closest('.ig-gallery-section-row').data('index');
                var template = (typeof igHomepageFields !== 'undefined' && igHomepageFields.imageRowTemplate)
                    ? igHomepageFields.imageRowTemplate
                    : '';
                if (template) {
                    var html = template
                        .replace(/__SECTION_INDEX__/g, sectionIndex)
                        .replace(/__IMG_INDEX__/g, 0);
                    $list.append(html);
                }
            } else {
                reindexImageRows($list);
            }
        });
    }

    function reindexGallerySections() {
        $('#ig_gallery_sections_wrap .ig-gallery-section-row').each(function(idx) {
            var $row = $(this);
            $row.attr('data-index', idx);
            $row.find('[name*="ig_gallery_sections"]').each(function() {
                var name = $(this).attr('name');
                name = name.replace(/ig_gallery_sections\[\d+\]/, 'ig_gallery_sections[' + idx + ']');
                $(this).attr('name', name);
            });
            $row.find('.ig-add-image').data('section', idx);
        });
    }

    function reindexImageRows($list) {
        $list.find('.ig-image-row').each(function(idx) {
            var $row = $(this);
            var sectionIndex = $row.closest('.ig-gallery-section-row').data('index');
            $row.attr('data-img-index', idx);
            $row.find('[name*="[images]"]').each(function() {
                var name = $(this).attr('name');
                name = name.replace(/\[images\]\[\d+\]/, '[images][' + idx + ']');
                $(this).attr('name', name);
            });
        });
    }

    function updateSectionNumbers() {
        $('#ig_gallery_sections_wrap .ig-gallery-section-row').each(function(idx) {
            $(this).find('.ig-section-num').text('#' + (idx + 1));
        });
    }

    function initEditorForSection(sectionIndex) {
        var editorId = 'ig_gallery_section_' + sectionIndex + '_short_desc';
        var $textarea = $('#' + editorId);
        if ($textarea.length && typeof wp !== 'undefined' && wp.editor && wp.editor.initialize) {
            wp.editor.initialize(editorId, {
                tinymce: {
                    wp_autoresize_on: true,
                    toolbar1: 'formatselect,bold,italic,underline,blockquote,link,unlink,bullist,numlist',
                    resize: true
                },
                quicktags: true,
                media_buttons: true
            });
        }
    }
})(jQuery);
