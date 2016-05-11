$(document).ready(function () {
    ctrlPublic = new ControllerPublic();
    ctrlPublic.init(ctrlPublic);

});
var ControllerPublic = function () {

    this.login = '#login';
    this.password = '#password';
    this.btnSubmit = '#submitButton';

    this.init = function (obj) {
        $.backstretch("vendor/public/img/backgrounds/1.jpg");
        obj.connection(obj);
        obj.sendWhenEnterPressed(obj);
        obj.inscriptionToggle(obj);
        obj.sendInscription(obj);
        obj.chooseTeam(obj);
        obj.loadTeam(obj);
    },

        this.loadTeam = function (obj) {
            $.getJSON('index.php?a=getTeam', function (resp) {
                if(resp.isSuccess){
                    $.each(resp.data, function (index,value) {
                        $('#joinTeamInput').append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });

        }

        this.chooseTeam = function (obj) {
            $('#type').on('change', function (e) {
                var createTeam =  $('#createTeam');
                var joinTeam =  $('#joinTeam');
                if($(this).val() == 0){
                    joinTeam.removeAttr('hidden','hidden');
                    createTeam.attr('hidden', 'hidden');
                }
                else{
                    createTeam.removeAttr('hidden','hidden');
                    joinTeam.attr('hidden', 'hidden');
                }
            })
        },

        this.inscriptionToggle = function (obj) {
            $('#inscriptionButton').click(function (e) {
                e.preventDefault();
                $('#inscriptionModal').modal('show');
            });
        };

    this.sendInscription = function () {
        $('#sendInscriptionButton').click(function (e) {
            e.preventDefault();
            var login = $('#loginModal').val();
            var password = $('#passwordModal').val();
            var lastName = $('#nom').val();
            var prenom = $('#prenom').val();
            var type = $('#type').val();
            var createTeam = (type == 1);
            var contentTeam = (createTeam == 1) ? $('#createTeamInput').val() : $('#joinTeamInput').val();
            console.log(contentTeam);
            $.post('index.php?a=inscription',{login : login, password: password, lastName: lastName, name: prenom, type:type, createTeam:createTeam, contentTeam:contentTeam } ,function (resp) {
                if(resp.isSuccess){
                    $('#inscriptionModal').modal('hide');
                    swal("Vous pouvez maintenant vous connecter",'','success')
                }
            },'json');
        });
    },

        this.connection = function (obj) {
            $(obj.btnSubmit).click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                obj.ajaxConnectionCall(obj);
            });
        },

        this.ajaxConnectionCall = function (obj) {
            $.post('index.php?a=connection', {
                login: $(obj.login).val(),
                password: $(obj.password).val()
            }, function (resp) {
                if (resp.data) {
                    window.location.assign("index.php?a=home");
                }
                else {
                    swal('Mauvais identifiant/login'); //TODO SWAL
                }
            }, 'json');

        },

        this.sendWhenEnterPressed = function (obj) {
            $(document).keypress(function (e) {
                if (e.which == 13) {
                    obj.ajaxConnectionCall(obj);
                }
            });
        }
};

