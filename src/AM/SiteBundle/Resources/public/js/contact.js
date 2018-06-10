$(function() {
    // Connexion
    $('#btn_connexion').on("click", function() {
        var email = $("#email").val();
        var password = $("#password").val();
        $.ajax({
            type : 'POST',
            url : $('#form_connexion').attr('action'),
            data : $('#form_connexion').serialize(),
            dataType: 'html',
            success: function(code_html, statut, data){
                // window.location.replace('index.php?action=connexion&email=' + email + '&password=' + password);
            },
            error : function(resultat, statut, erreur){
            },
            complete : function(resultat, statut){
            }
        });

    });
    
    //Contrôle de la saisie dans contact
    $('#btn_commentaire').on("click", function() {
        $('#error_author').hide();
        $('#error_comment').hide();
            
        //initialisation des variables et récupération
        var author = $("#author").val();
        var comment = $("#comment").val();

        
        //initialisation des variables boolean de controle
        var resAuthor = true;
        var resComment = true;
        
        //test nom et prenom si vide et regex html
        if (author == ''){
            resAuthor = false;
            $('#error_author').show();
        }
        if (comment == ''){
            resComment = false;
            $('#error_comment').show();
        }
        
        if (resAuthor && resComment) {
            $.ajax({
                url : 'index.php?action=addComment',
                type : 'GET',
                data : {
                    nom : nom,
                    prenom : prenom,
                },
                dataType: 'html',
                success: function(code_html, statut){
//                    window.location.replace('index.php?action=attente_validation');
                },
                error : function(resultat, statut, erreur){   
                },
                complete : function(resultat, statut){
                }
            });
        };
    });
        
    //Contrôle de la saisie dans contact
    $('#btn_contact').on("click", function() {
        $('#error_nom').hide();
        $('#error_prenom').hide();
        $('#error_nom_prenom').hide();
        $('#error_email').hide();
        $('#error_email2').hide();
        $('#error_message').hide();
            
        //initialisation des variables et récupération
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        var message = $("#message").val();
        
        //initialisation des variables boolean de controle
        var resNom = true;
        var resPrenom = true;
        var resEmail = true;
        var resMessage = true;
        
        //test nom et prenom si vide et regex html
        if (nom == '' && prenom == ''){
            resNom = false;
            resPrenom = false;
            $('#error_nom_prenom').show();
        }
        if (nom == '' && prenom != ''){
            resNom = false;
            $('#error_nom').show();
        }
        if (prenom == '' && nom != ''){
            resPrenom = false;
            $('#error_prenom').show();
        }
        
        //test email si vide et regex adresse mail
        var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9_-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email == ''){
            resEmail = false;
            $('#error_email').show();
        }
        if (email != '') {
            if (!regexEmail.test(email)) {
            resEmail = false;
            $('#error_email2').show();
            }
        }
        
        //test message si vide et regex html
        if (message == ''){
            resMessage = false;
            $('#error_message').show();
        }
        
        if (resNom && resPrenom && resEmail && resMessage) {
            $.ajax({
                url : 'index.php?action=addContact',
                type : 'GET',
                data : {
                    nom : nom,
                    prenom : prenom,
                    email : email,
                    message : message,
                },
                dataType: 'html',
                success: function(code_html, statut){
                    window.location.replace('index.php?action=aboutme');
                },
                error : function(resultat, statut, erreur){   
                },
                complete : function(resultat, statut){
                }
            });
        };
    });
    
    //Contrôle de la saisie dans contact
    $('#btn_inscription').on("click", function() {
        $('#error_nom').hide();
        $('#error_prenom').hide();
        $('#error_nom_prenom').hide();
        $('#error_email').hide();
        $('#error_email2').hide();
        $('#error_password').hide();
            
        //initialisation des variables et récupération
        var insNom = $("#ins_nom").val();
        var insPrenom = $("#ins_prenom").val();
        var insEmail = $("#ins_email").val();
        var insPassword = $("#ins_password").val();
        console.log(insNom, insPrenom);
        console.log(insEmail);
        console.log(insPassword);
        
        //initialisation des variables boolean de controle
        var resNom = true;
        var resPrenom = true;
        var resEmail = true;
        var resPassword = true;
        
        //test nom et prenom si vide et regex html
        if ((insNom == '') && (insPrenom == '')) {
            resNom = false;
            resPrenom = false;
            $('#error_nom_prenom').show();
        }
        if ((insNom == '') && (insPrenom != '')) {
            resNom = false;
            $('#error_nom').show();
        }
        if ((insPrenom == '') && (insNom != '')) {
            resPrenom = false;
            $('#error_prenom').show();
        }
        
        //test email si vide et regex adresse mail
        var regexEmail = /^([a-zA-Z0-9_.-])+\@(([a-zA-Z0-9_-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (insEmail == ''){
            resEmail = false;
            $('#error_email').show();
        }
        if (insEmail != '') {
            if (!regexEmail.test(insEmail)) {
            resEmail = false;
            $('#error_email2').show();
            }
        }
        
        //test message si vide et regex html
        if (insPassword == ''){
            resPassword = false;
            $('#error_password').show();
        }
        
        if (resNom && resPrenom && resEmail && resPassword) {
            $.ajax({
                url : $('#form_inscription').attr('action'),
                type : 'GET',
                data : {
                    nom : insNom,
                    prenom : insPrenom,
                    email : insEmail,
                    password : insPassword,
                },
                dataType: 'html',
                success: function(code_html, statut){
                    
                    window.location.replace('index.php?action=attente_validation');
                },
                error : function(resultat, statut, erreur){   
                },
                complete : function(resultat, statut){
                }
            });
        };
    });
});