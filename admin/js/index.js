  $(document).ready(function(){
        $('.log-btn').click(function(){
          var usuario = $('#usuario').val();
          var senha = $('#senha').val();
             $.ajax({
                dataType: 'json',
                method: "post",
                data: {
                    usuario: usuario,
                    senha: senha
                },
                url: 'verificalogin.php',
                success: function(response){
                  if(response.info == '1'){
                    location.href = 'index.php?logadosession=true&user='+usuario+'&id='+response.id+'&nome='+response.nome;
                  }
                  if(response.info == '2'){
                         $('.log-status').addClass('wrong-entry');
                           $('.alert').fadeIn(500);
                           setTimeout( "$('.alert').fadeOut(1500);",3000 );
                  }
                }
            });
          });
          $('.form-control').keypress(function(){
              $('.log-status').removeClass('wrong-entry');
          });
    });