function callSummernote() {
    $('.richtext').summernote({
        placeholder: 'Your content here',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', []],
            ['font', ['bold', 'underline', 'clear']],
            ['color', []],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen']]
        ]
    });
}
callSummernote();