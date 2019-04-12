$(document).ready( function () {
    $('.change-slug').click(function(){
        if($(this).hasClass('active')){
            var slug = $('input[name=inputslug]').val();
            $('input[name=inputslug]').remove();
            $('b.slug').html(slug);
            $('input[name=slug]').val(slug);
            $('.change-slug').html('Modifier').removeClass('active');
        }else{
            var slug = $('b.slug').html();
            $('b.slug').html('');
            $('<input type="text" name="inputslug" value="' + slug + '" />').insertBefore('.change-slug');
            $('.change-slug').html('Enregistrer').addClass('active');
        }
        return false;
    });
    $('#chapters').DataTable({
        "language": {
        "sProcessing":     "Traitement en cours...",
        "sSearch":         "Rechercher&nbsp;:",
        "searchPlaceholder": "Rechercher",
        "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
        "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
        "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        "sInfoPostFix":    "",
        "sLoadingRecords": "Chargement en cours...",
        "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
        "oPaginate": {
            "sFirst":      "Premier",
            "sPrevious":   "Pr&eacute;c&eacute;dent",
            "sNext":       "Suivant",
            "sLast":       "Dernier"
        },
        "oAria": {
            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
            "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
        },
        "select": {
                "rows": {
                    _: "%d lignes séléctionnées",
                    0: "Aucune ligne séléctionnée",
                    1: "1 ligne séléctionnée"
                } 
        }
}});
} );