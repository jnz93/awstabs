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

            var titleDefault = '<h3>Top 3 Produto X</h3>',
                openTable = '<table class="simple" style="border: none"><tbody>',
                rowOne = '<tr><td style="text-align: left; width: 32%;">1º - </td><td style="text-align: left; width: 50%;">' + selected_text + '</td><td style="text-align: left; width: 18%;"><button class="btn-primary">CTA 1</button></td></tr>',
                rowTwo = '<tr><td style="text-align: left; width: 32%;">2º - </td><td style="text-align: left; width: 50%;">' + selected_text + '</td><td style="text-align: left; width: 18%;"><button class="btn-primary">CTA 2</button></td></tr>',
                rowThree = '<tr><td style="text-align: left; width: 32%;">3º - </td><td style="text-align: left; width: 50%;">' + selected_text + '</td><td style="text-align: left; width: 18%;"><button class="btn-primary">CTA 3</button></td></tr>',
                closeTable = '</tbody></table>',
                returnText = '';


            returnText = titleDefault + openTable + rowOne + rowTwo + rowThree + closeTable;
            editor.execCommand('mceReplaceContent', false, returnText);
            return;
        });
    });
})();