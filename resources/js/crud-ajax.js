;(function (global, $) {
    "use strict";

    //variable global
    let ADMIN = global.ADMIN = global.ADMIN || {};

    //elementos globales
    ADMIN.ELEMENTS = {};
    ADMIN.ELEMENTS.body = $('body');

    //Eventos
    ADMIN.ELEMENTS.body.on('click', '.open-modal', openModal);
    ADMIN.ELEMENTS.body.on('submit', '.save-ajax', saveAjax);
    ADMIN.ELEMENTS.body.on('submit', '.delete-ajax', deleteAjax);
    ADMIN.ELEMENTS.body.on('datatable.refresh', refreshDatatable);

    //Implementaciones
    /**
     *
     * @param event
     */
    function openModal(event) {
        event.preventDefault();

        let target = $(event.target), container = $('#modal-add');
        let url = target.attr('href') || target.data('url');

        if (url === undefined) target = $(event.currentTarget);

        url = target.attr('href') || target.data('url');

        $.ajax({
            url: url, dataType: 'html',
            beforeSend: function () {
                //spinner(true);
            },
            success: function (response) {
                //spinner(false);
                container.html(response);
                container.find('.modal-crud').modal('show');
            },
            error: function (response) {
                let json = JSON.parse(response.responseText);
                //spinner(false);
                //showToast('error', 'Error!', json.error);
            }
        })
    }

    /**
     *
     * @param evento
     */
    function saveAjax(evento) {
        evento.preventDefault();

        let form = $(evento.currentTarget);
        let data = form.serialize();

        let options = {
            url: form.attr('action'), type: form.attr('method'), dataType: 'json',
            beforeSend: function () {
                removeErrors();
                spinner(true);
            },
            success: function (response) {
                spinner(false);
                showToast(response.toast.type, response.toast.title, response.toast.message);
                if (response.success) {
                    if (response.dismissModal) {
                        $('.modal').modal('hide');
                    }
                    if (response.resetForm) {
                        form.trigger('reset');
                    }
                    if (response.reloadPage){
                        location.reload();
                    }
                    if (response.refreshTable) {
                        ADMIN.ELEMENTS.body.trigger('datatable.refresh');
                    }
                }
            },
            error: function (response) {
                spinner(false);
                switch (response.status) {
                    case 422:
                        showErrors(response);
                        break;

                    default:
                        let json = JSON.parse(response.responseText);
                        showToast('error', 'Error!', json.error);
                        break;
                }
            }
        };

        if (form.data('has-files')) {
            data = new FormData(form[0]);
            options.contentType = false;
            options.processData = false;
            options.headers = {'X-CSRF-TOKEN': form.find('input[name=_token]').val()};
        }

        options.data = data;

        $.ajax(options);
    }

    /**
     *
     * @param event
     */
    function deleteAjax(event) {
        event.preventDefault();

        let form = $(event.target);

        let options = {
            url: form.attr('action'),
            type: 'DELETE',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': form.find('input[name=_token]').val()},
            beforeSend: function () {
                spinner(true);
            },
            success: function (response) {
                spinner(false);
                if (response.success) {
                    form.find('.modal').modal('hide');

                    showToast(response.toast.type, response.toast.title, response.toast.message);

                    if (response.refresh_table || response.refresh_table == undefined) {
                        ADMIN.ELEMENTS.body.trigger('datatable.refresh');
                    }

                    if (response.refreshCalendar) {
                        calendar.fullCalendar('refetchEvents');
                    }

                    if (response.reload_page) {
                        location.reload();
                    }
                } else {
                    let json = JSON.parse(response.responseText);
                    showToast('error', 'Error!', json.error);
                }
            },
            error: function (response) {
                spinner(false);
                switch (response.status) {
                    case 422:
                        showErrors(response);
                        break;

                    default:
                        let json = JSON.parse(response.responseText);
                        showToast('error', 'Error!', json.error);
                        break;
                }
            }
        };

        $.ajax(options);
    }

    /**
     *
     * @param response
     */
    function showErrors(response) {
        let errors = JSON.parse(response.responseText).errors;

        $.each(errors, function (element, index) {
            $('[name=' + element + ']').addClass('is-invalid');
            $('small', 'span[data-feedback="' + element + '"]').text(index).addClass('text-danger');
        });
    }

    /**
     *
     */
    function removeErrors() {
        $('.is-invalid').removeClass('is-invalid');
    }

    /**
     *
     * @param event
     */
    function refreshDatatable(event) {
        window.LaravelDataTables.dataTableBuilder.ajax.reload();
    }

})(window, jQuery);

/**
 *
 * @param type
 * @param title
 * @param message
 */
function showToast(type, title, message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr[type](message, title);
}

/**
 *
 * @param show
 */
function spinner(show) {
    if (show) {
        NProgress.start();
    } else {
        NProgress.done();
    }
}
