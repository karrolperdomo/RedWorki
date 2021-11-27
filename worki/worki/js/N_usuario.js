/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$("input[name='nom_usuario']").attr('disabled', 'disabled');
$("input[name='ape_usuario']").attr('disabled', 'disabled');
$("input[name='extension']").attr('disabled', 'disabled');

$("select[name='usuarios_sede']").change(function () {
    var jSelect2=$("input[name='nom_usuario']");
    var jSelect3=$("input[name='ape_usuario']");
    var jSelect4=$("input[name='extension']");
    
    if (jSelect2.attr('disabled') && jSelect3.attr('disabled') && jSelect4.attr('disabled')) {
        
        jSelect2.removeAttr('disabled');
        jSelect3.removeAttr('disabled');
        jSelect4.removeAttr('disabled');
    }
    else
    {
      jSelect2.attr('disabled','disabled');
      jSelect3.attr('disabled','disabled');
      jSelect4.attr('disabled','disabled');
    }

});


