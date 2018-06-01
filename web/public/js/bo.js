$(function() {
    $('#summernote').summernote({
        height: 300,
        theme: 'monokai'
    });

    $('.message').summernote({
        height: 300,
        theme: 'monokai'
    });
    
    // Deconnexion
    $('#btn_deconnexion').on("click", function() {
        $.ajax({
            url : 'index.php?action=deconnexion',
            type : 'GET',
//            data : 'text',
//            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php');
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
        
    });
    
    // Acces back office par menu-connexion
    $('#btn_addPost').on("click", function() {
        var title = $("#title").val();
        var content = $('textarea[name="content"]').html($('#summernote').code());
        $.ajax({
            type : 'POST',
            url : $('#formAddPost').attr('action'),
            data : $('#formAddPost').serialize(),
            dataType: 'html',
            success: function(code_html, statut, data){
                window.location.replace('index.php?action=addPost&title=' + title + '&content=' + content + '&code=' + code);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    $('.modifier_page').on("click", function(){
        var id = $(this).val();
        $.ajax({
            url : 'index.php?action=page_modifier',
            type : 'GET',
            data : {
                id : id,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=page_modifier&id=' + id);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Modifier MesInformations
    $('#modifier_mesInfos').on("click", function() {
        var id = $(this).val();
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        console.log(id, nom, prenom, email);
        $.ajax({
            url : 'index.php?action=modifier_mesInfos',
            type : 'GET',
            data : {
                id : id,
                nom : nom,
                prenom : prenom,
                email : email,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=modifier_mesInfos&id=' + id + '&nom=' + nom + '&prenom=' + prenom + '&email=' + email);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Modifier MonAbout
    $('.modifier_monAbout').on("click", function() {
        var id = $(this).val();
        var titre = $(".titre").val();
        var message = $(".message").val();
        $.ajax({
            url : 'index.php?action=modifier_monAbout',
            type : 'GET',
            data : {
                id : id,
                titre : titre,
                message : message,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=modifier_monAbout&id=' + id + '&titre=' + titre + '&message=' + message);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Modifier MesPost
    $('#modifier_monPost').on("click", function() {
        var id = $(this).val();
        var titre = $("#titre").val();
        var message = $("#message").val();
        $.ajax({
            url : 'index.php?action=modifier_mesPosts',
            type : 'GET',
            data : {
                id : id,
                titre : titre,
                message : message,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=modifier_monPost&id=' + id + '&titre=' + titre + '&message=' + message);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Supprimer post
    $('#delete_post').on("click", function() {
        var id = $('input[name="id"]').val();
        $.ajax({
            url : 'index.php?action=delete_post',
            type : 'GET',
            data : {
                id : id,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=delete_post&id='+ id);
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Supprimer mail
    $('#delete_mail').on("click", function() {
        var id = $(this).val();
        $.ajax({
            url : 'index.php?action=delete_mail',
            type : 'GET',
            data : {
                id : id,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=messagerie');
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
    // Supprimer userTemp
    $('.delete_userTemp').on("click", function() {
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url : 'index.php?action=delete_userTemp',
            type : 'GET',
            data : {
                id : id,
            },
            dataType: 'html',
            success: function(code_html, statut){
                window.location.replace('index.php?action=usersTemp');
            },
            error : function(resultat, statut, erreur){   
            },
            complete : function(resultat, statut){
            }
        });
    });
    
});