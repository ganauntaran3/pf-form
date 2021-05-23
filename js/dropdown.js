const getPostFetchOptions = (data = {}) => {
	const body = [];

	for (const key in data) {
		body.push(`${key}=${data[key]}`);
	}

	return {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: body.join('&'),
	};
};

const isResponseSuccess = response => {
	return response.status === 200 || response.ok;
};

const getCities = async id => {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				const response = JSON.parse(this.responseText);
				return response.error
					? reject({ data: response.data, message: response.message })
					: resolve({ data: response.data, message: response.message });
			} else if (this.readyState === 4 && this.status >= 400) {
				return reject({ data: [], message: this.statusText });
			}
		};

		xhr.open('POST', 'ajax/ajax_get_cities.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(`state_id=${id}`);
	});
};

const getCountries = () => {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				const response = JSON.parse(this.responseText);
				return response.error
					? reject({ data: response.data, message: response.message })
					: resolve({ data: response.data, message: response.message });
			} else if (this.readyState === 4 && this.status >= 400) {
				return reject({ data: [], message: this.statusText });
			}
		};

		xhr.open('GET', 'ajax/ajax_get_countries.php');
		xhr.send();
	});
};

const getStates = async id => {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();

		xhr.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				const response = JSON.parse(this.responseText);
				return response.error
					? reject({ data: response.data, message: response.message })
					: resolve({ data: response.data, message: response.message });
			} else if (this.readyState === 4 && this.status >= 400) {
				return reject({ data: [], message: this.statusText });
			}
		};

		xhr.open('POST', 'ajax/ajax_get_states.php');
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(`country_id=${id}`);
	});
};

const citiesDatalist = document.querySelector('datalist#cities');
const cityInput = document.querySelector('input#city');
const countriesDatalist = document.querySelector('datalist#countries');
const countryInput = document.querySelector('input#country');
const statesDatalist = document.querySelector('datalist#states');
const stateInput = document.querySelector('input#state');

const getIdFromValueInDatalist = (value, datalist) => {
	return (
		Array.from(datalist.querySelectorAll('option')).find(option => {
			return option.getAttribute('value') === value;
		})?.dataset?.js ?? null
	);
};

try {
	countryInput.addEventListener('focus', async function () {
		getCountries().then(countries => {
			countriesDatalist.innerHTML = countries.data
				.map(country => {
					return `<option data-js="${country.id}" value="${country.name}" />`;
				})
				.join('');
		});
	});

	countryInput.addEventListener('focusout', async function () {
		const cta = document.getElementById('cta');
		const contactBtn = document.createElement('a');
		const submitBtn = cta.querySelector('#cta > button[type=submit]');

		const country = countryInput.value;
		const banned = await (await fetch('banned.json')).json();

		if (banned.countries.includes(country)) {
			contactBtn.className = 'btn btn-primary';
			contactBtn.href = 'https://t.me/Gana_11';
			contactBtn.id = 'contact-btn';
			contactBtn.innerText = 'Chat me for more!';

			cta.prepend(contactBtn);
			submitBtn.setAttribute('disabled', true);
		} else {
			cta.contains(cta.querySelector('#contact-btn')) &&
				cta.removeChild(cta.querySelector('#contact-btn'));
			submitBtn.removeAttribute('disabled');
		}
	});

	stateInput.addEventListener('focus', async function () {
		const countryId = getIdFromValueInDatalist(
			countryInput.value,
			countriesDatalist
		);

		const states = await getStates(countryId);

		statesDatalist.innerHTML = states.data
			.map(state => {
				return `<option data-js="${state.id}" value="${state.name}" />`;
			})
			.join('');
	});

	cityInput.addEventListener('focus', async function () {
		const stateId = getIdFromValueInDatalist(stateInput.value, statesDatalist);

		const cities = await getCities(stateId);

		citiesDatalist.innerHTML = cities.data
			.map(city => {
				return `<option data-js="${city.id}" value="${city.name}" />`;
			})
			.join('');
	});
} catch (err) {
	console.warn(err);
}
