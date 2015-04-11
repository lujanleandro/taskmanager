<!-- Modal Contacto -->		
<div id="contactFormCtn"  title="Solicitar Precio">
<div id="Contact-Wrapper" >

<form method="post" action="/contactenos/" id="contactForm">
	<input type="hidden" name="postForm" value="1" />
	<input type="hidden" name="productLink" value="" />
	<input type="hidden" name="comment" value="El usuario consulta por presupuesto." />

	<div class="element">
		<input type="text" placeholder="Nombre" name="name" class="required text" minlength="2"/>
	</div>
    
	<div class="element">
		<input type="text" placeholder="Email" name="email" class="text required"/>
	</div>
    <!--
	<div class="element">
		<input type="submit" id="submit"/>
	</div>
	-->

</form>
</div><!--end Contact-Wrapper-->
</div>
  
<script type="text/javascript">
var dialogOpts = {
	resizable: false,
	bgiframe: true,
	modal: true,
	buttons: [{
		text: "Enviar",
		click: function() {
			$('#contactForm').submit();
        },
		type: "submit"
	},
	{
		text: "Cancelar",
		click: function() {
		  $( this ).dialog( "close" );
		}
	}],
	autoOpen: false
};

$('#contactFormCtn').dialog(dialogOpts);
$('.contactDialogLink').click(function() {
	var valueLink = $( this ).attr( "href" );
	$( "input[name='productLink']" ).val( valueLink );
	$('#contactFormCtn').dialog('open');
  return false;
});

// Le paso el link en el mail
$('#contactDialogLink').value();
</script>