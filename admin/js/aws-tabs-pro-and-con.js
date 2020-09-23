(function() {
    tinymce.PluginManager.add( 'proAndConBtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('proAndConBtn', {
            title: 'Prós x Contras',
            cmd: 'proAndConBtn',
            image: url + '/img/pros-and-cons.png',
        });
        editor.addCommand('proAndConBtn', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });

            var titleList = '<h3>Adicione um título para lista</h3>',
                titlePro = '<h4 style="display: block; margin: 12px auto; padding-left: 16px; background-color:#479c47; color: #f2f2f2;">Prós</h4>',
                titleCon = '<h4 style="display: block; margin: 12px auto; padding-left: 16px; background-color:#e04343; color: #f2f2f2;">Contras</h4>';
            
            var openWrapper = '<div style="width: 100%; display: flex;">',
                endWrapper = '</div>';

            var openWrapPro = '<div style="width: 50%;">',
                endWrapPro = '</div>';

            var openWrapCon = '<div style="width: 50%">',
                endWrapCon = '</div>';

            var openListPro = '<ul class="list-of-pros">',
                endListPro = '</ul>';

            var openListCon = '<ul class="list-of-cons">',
                endListCon = '</ul>';

            var itemListPro = '<li>'+ selected_text +'</li>',
                itemListCon = '<li>'+ selected_text +'</li>';

            returList = titleList
                        + openWrapper
                        + openWrapPro
                        + titlePro
                        + openListPro
                        + itemListPro
                        + endListPro
                        + endWrapPro
                        + openWrapCon
                        + titleCon
                        + openListCon
                        + itemListCon
                        + endListCon
                        + endWrapCon
                        + endWrapper;

            editor.execCommand('mceReplaceContent', false, returList);
            console.log(editor);
            return;
        });
    });
})();