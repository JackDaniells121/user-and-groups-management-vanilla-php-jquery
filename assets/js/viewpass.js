function showPassword(elem) {
    let input = $(elem).parent().find("input");

    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
    } else {
        input.attr('type', 'password');
    }
}
