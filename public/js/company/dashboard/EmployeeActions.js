class EmployeeActions {
    btnDelete = '#btn-delete-employee';
    token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    delete() {
        $(this.btnDelete).on('click', (event) => {
            const id = $(`#${event.target.id}`).parents('tr').attr('id');
            const deleteUrl = '/company/dashboard/employee/' + id;

            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': this.token
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.log(status)
                }
            });
        });
    }
}

const employeeActions = new EmployeeActions();