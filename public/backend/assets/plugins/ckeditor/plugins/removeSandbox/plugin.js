CKEDITOR.plugins.add('removeSandbox', {
    init: function(editor) {
        editor.on('contentDom', function() {
            editor.on('setData', function(event) {
                var data = event.data.dataValue;
                data = data.replace(/<iframe[^>]*sandbox[^>]*>/gi, function(match) {
                    return match.replace(/sandbox="[^"]*"/i, '');
                });
                
                event.data.dataValue = data;
            });

            editor.on('getData', function(event) {
                var data = event.data.dataValue;
                data = data.replace(/<iframe[^>]*sandbox[^>]*>/gi, function(match) {
                    return match.replace(/sandbox="[^"]*"/i, '');
                });
                
                event.data.dataValue = data;
            });
        });
    }
});
