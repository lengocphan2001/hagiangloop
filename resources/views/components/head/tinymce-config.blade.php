<script src="https://cdn.tiny.cloud/1/xhvi99zf95ueinybzalp9vwc7yaolsr1rxibrza2dzwb9c8e/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: '{{ $selector }}',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | image | link | code',
        image_uploadtab: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_url: '{{ $uploadUrl }}',
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ $uploadUrl }}');
                
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                
                xhr.upload.onprogress = function (e) {
                    progress(e.loaded / e.total * 100);
                };
                
                xhr.onload = function () {
                    if (xhr.status === 403) {
                        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                        return;
                    }
                    
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    
                    var json = JSON.parse(xhr.responseText);
                    
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    
                    resolve(json.location);
                };
                
                xhr.onerror = function () {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };
                
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                
                xhr.send(formData);
            });
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; line-height:1.75; color:#374151; } ' +
            'h1 { font-size:2.25em; font-weight:700; color:#111827; margin-top:0; margin-bottom:0.8888889em; } ' +
            'h2 { font-size:1.5em; font-weight:700; color:#111827; margin-top:2em; margin-bottom:1em; } ' +
            'h3 { font-size:1.25em; font-weight:700; color:#111827; margin-top:1.6em; margin-bottom:0.6em; } ' +
            'p { margin-top:1.25em; margin-bottom:1.25em; } ' +
            'ul, ol { margin-top:1.25em; margin-bottom:1.25em; padding-left:1.625em; } ' +
            'img { max-width:100%; height:auto; border-radius:0.5rem; margin:2em 0; } ' +
            'a { color:#f59e0b; text-decoration:underline; } ' +
            'blockquote { border-left:0.25rem solid #e5e7eb; padding-left:1em; margin:1.6em 0; font-style:italic; }',
        // Preserve classes and attributes - allow all classes on all elements
        extended_valid_elements: 'h1[class|id|style],h2[class|id|style],h3[class|id|style],h4[class|id|style],h5[class|id|style],h6[class|id|style],p[class|id|style],div[class|id|style],span[class|id|style],ul[class|id|style],ol[class|id|style],li[class|id|style],img[class|id|style|src|alt|width|height],a[class|id|style|href|target],strong[class|id|style],b[class|id|style],em[class|id|style],i[class|id|style],table[class|id|style],thead[class|id|style],tbody[class|id|style],tr[class|id|style],td[class|id|style],th[class|id|style],blockquote[class|id|style],code[class|id|style],pre[class|id|style]',
        // Don't strip classes
        cleanup: false,
        verify_html: false,
        // Preserve formatting when pasting
        paste_as_text: false,
        paste_retain_style_properties: 'all',
        paste_remove_styles_if_webkit: false,
        paste_strip_class_attributes: 'none',
        paste_remove_spans: false,
        paste_auto_cleanup_on_paste: false,
        // Allow all classes
        valid_classes: '*'
    });
</script>
