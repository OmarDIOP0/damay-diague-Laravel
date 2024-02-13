

export function getUser(callback) {
    $.getJSON('/users').done(response => {
        console.log(response);
        callback(response);
    }).fail(error => {
        console.log(error)
    })
}