var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
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

const inputDate = document.querySelector('input[type=date][date-max-today]');
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

const inputsWithList = document.querySelectorAll( 'input[list][multiple]' );

if ( inputsWithList && inputsWithList.length ) {
	inputsWithList.forEach( function ( /** @type {HTMLInputElement} */ input )
	{
		if ( input.type !== 'email' && input.type !== 'file' ) {
			input.addEventListener( 'input', function ( /** @type {Event|InputEvent} */ event )
			{

				/** @type {HTMLInputElement} */
				const input = event.target;

				/** @type {HTMLDataListElement} */
				const datalist = input.list;

				/** @type {HTMLCollection} */
				const options = datalist.options;

				if ( options && options.length ) {
					[ ...options ].forEach( function ( /** @type {HTMLOptionElement} */ option )
					{
						if ( !option.trustedValue ) {
							option.trustedValue = option.value;
							( datalist.allOptionValues = datalist.allOptionValues || new Set() ).add( option.value );
						}
					} );

					/** @type {Boolean} */
					let someValueIsSuffix = false;

					for ( const option of options ) {
						if ( input.value.endsWith( option.trustedValue ) ) {
							someValueIsSuffix = true;
							break;
						}
					}

					/** @type {Array} */
					const parts = input.value.split( ' , ' ).join( ',' ).split( ' ,' ).join( ',' ).split( ',' );

					/** @type {String} */
					let lastPart = parts.slice( -1 ).pop();

					if ( lastPart.startsWith( ' ' ) ) {
						lastPart = lastPart.trimStart();
					}
					[ ...options ].forEach( function ( /** @type {HTMLOptionElement} */ option )
					{
						option.hidden = false;
						if ( !someValueIsSuffix ) {
							if ( option.trustedValue.startsWith( lastPart ) ) {
								option.value = input.value + option.trustedValue.replace( lastPart, '' );
							} else {
								option.hidden = true;
							}
						}
					} );
				}
			}, {
				capture: false,
				once: false,
				passive: true,
			} );
		}
	} );
}

const inputsImage = document.querySelectorAll('input[type=file][data-input-photo]');
if (inputsImage)
inputsImage.forEach(input => {
	input.addEventListener('change', (ev) =>{
		if (ev.target.files && ev.target.files[0])
		{
			const img = ev.target.files[0];
			const elementID = ev.target.getAttribute("data-input-photo");
			const elementImage = document.getElementById(elementID);
			
			if (elementImage)			
				elementImage.style.backgroundImage = "url(" + URL.createObjectURL(img) + ")";
		}
	})
});