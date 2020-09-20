(function() {
    tinymce.PluginManager.add( 'topThreeBtn', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('topThreeBtn', {
            title: 'Top três + CTA',
            cmd: 'topThreeBtn',
            image: url + '/img/ico-ranking.png',
        });
        editor.addCommand('topThreeBtn', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });

            var titleDefault = '<h3>Adicione um título para tabela</h3>',
                openTable = '<table><tbody>',
                rowOne = '<tr><th style="text-align: left;">1º - </th><td style="text-align: left;">' + selected_text + '</td><td style="text-align: left;"><button class="btn-primary">CTA 1</button></td></tr>',
                rowTwo = '<tr><th style="text-align: left;">2º - </th><td style="text-align: left;">' + selected_text + '</td><td style="text-align: left;"><button class="btn-primary">CTA 2</button></td></tr>',
                rowThree = '<tr><th style="text-align: left;">3º - </th><td style="text-align: left;">' + selected_text + '</td><td style="text-align: left;"><button class="btn-primary">CTA 3</button></td></tr>',
                closeTable = '</tbody></table>',
                returnText = '';


            returnText = titleDefault + openTable + rowOne + rowTwo + rowThree + closeTable;
            editor.execCommand('mceReplaceContent', false, returnText);
            return;
        });
    });
})();