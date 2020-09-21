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

            var options = [
                'Fabricante',
                'Modelo',
                'Bateria',
                'Conectividade',
                'Tamanho',
                'Garantia',
                'Peso',
                'Teclado',
                'Visor',
                'Voltagem',
                'Aplicativo',
                'Cartões',
                'Câmera',
                'Tela',
                'SO'
            ];

            var tdsForTable = '';
            options.forEach(function(index){
                tdsForTable += '<tr><td style="width: 30%; text-align: left;">'+ index +'</td><td style="width: 70%; text-align: left;">' + selected_text + '</td></tr>';
            });

            var titleDefault = '<h3>Detalhes Técnicos do produto X</h3>',
                openTable = '<table><tbody>',
                closeTable = '</tbody></table>',
                outputHtml = '';
            
            outputHtml = titleDefault + openTable + tdsForTable + closeTable;

            editor.execCommand('mceReplaceContent', false, outputHtml);
            return;
        });
    });
})();