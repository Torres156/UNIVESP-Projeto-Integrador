
function formatDateBR(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [day, month, year].join('-');
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function regexNumber(value) {
    return value.replace(/[^0-9]/g, '');
}

const inputs_number = document.querySelectorAll('input[data-input-number]');
if (inputs_number)
    inputs_number.forEach(element => {
        element.addEventListener('input', (ev) => {
            ev.target.value = regexNumber(ev.target.value);
        });
    })


function regexPhone(value) {
    if (!value) return ""
    value = value.replace(/\D/g, '')
    value = value.replace(/(\d{2})(\d)/, "($1) $2")
    value = value.replace(/(\d)(\d{4})$/, "$1-$2")
    return value;
}

const inputs_phone = document.querySelectorAll('input[data-input-phone]')
if (inputs_phone)
    inputs_phone.forEach(element => {
        element.addEventListener('input', (ev) => {
            ev.target.value = regexPhone(ev.target.value);
        });
    });

const inputDate = document.querySelector('input[type=date]');
if (inputDate)
    inputDate.setAttribute('max', formatDate(Date.now()));

function changeBirthday(ev) {
    const value = ev.target.value;

    if (!isNaN(new Date(value))) {
        const nowDate = new Date(Date.now());
        const valueDate = new Date(value);

        const calc = new Date(nowDate.getTime() - valueDate.getTime()).getFullYear() - 1970;
        document.querySelector("#idade").value = calc + " anos";        
    }
}