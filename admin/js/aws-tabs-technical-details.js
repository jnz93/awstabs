(function() {
    tinymce.PluginManager.add( 'technicalDetails', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('technicalDetails', {
            title: 'Detalhes técnicos',
            cmd: 'technicalDetails',
            image: url + '/img/ico-details-technical.png',
        });
        editor.addCommand('technicalDetails', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });

            var titleDefault = '<h3>Detalhes Técnicos</h3>',
                openTable = '<table><tbody>',
                rowOne = '<tr><th style="text-align: left;"></th><td style="text-align: left;">' + selected_text + '</td></tr>',
                rowTwo = '<tr><th style="text-align: left;"></th><td style="text-align: left;">' + selected_text + '</td></tr>',
                rowThree = '<tr><th style="text-align: left;"></th><td style="text-align: left;">' + selected_text + '</td></tr>',
                closeTable = '</tbody></table>',
                returnText = '';


            returnText = titleDefault + openTable + rowOne + rowTwo + rowThree + closeTable;
            editor.execCommand('mceReplaceContent', false, returnText);
            return;
        });
    });
})();