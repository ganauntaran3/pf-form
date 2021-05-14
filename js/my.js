// document
//   .querySelector('#cta button[type=submit]')
//   .addEventListener('click', async function (e) {
//     e.preventDefault()
//     const countryId = document.getElementById('country_id').value

//     const res = await fetch('./banned.json')
//     const banned = await res.json()
//     const cta = document.getElementById('cta')

//     if (banned.countries.includes(+countryId)) {
//       const contactBtn = document.createElement('a')
//       const submitBtn = cta.querySelector('button[type=submit]')

//       contactBtn.href = 'https://t.me/Gana_11?text=hello gana' // link ke telegram
//       contactBtn.className = 'btn btn-primary'
//       contactBtn.textContent = 'Please contact Gana!' // caption buttonnya

//       submitBtn.setAttribute('disabled', true)

//       cta.innerHTML = contactBtn.outerHTML
//       cta.innerHTML += submitBtn.outerHTML

//       return
//     } else {
//       const contactBtn = cta.querySelector('a')
//       const form = cta.parentNode

//       if (cta.contains(contactBtn)) contactBtn.remove()
//       // form.submit()
//     }
//   })

const createTemplate = (obj = []) => {
  const innerDiv = document.createElement('div')
  const list = document.createElement('ul')

  // styling inner div
  innerDiv.classList.add('inner')
  innerDiv.setAttribute('role', 'listbox')
  innerDiv.setAttribute('aria-expanded', 'false')
  innerDiv.setAttribute('tabindex', '-1')
  innerDiv.style.maxHeight = '214.667px'
  innerDiv.style.minHeight = '0px'
  innerDiv.style.overflowY = 'auto'

  // styling list
  list.classList.add('dropdown-menu')
  list.classList.add('inner')
  list.classList.add('show')

  list.innerHTML = `` // reset value

  obj.map(({ id, name }) => {
    list.innerHTML += `
      <li>
          <a 
          role="option" 
          class="dropdown-item" 
          aria-disabled="false" 
          tabindex="0" 
          aria-selected="false">
          <span class="text">${name}</span>
          </a>
      </li>
      `
  })

  innerDiv.appendChild(list)

  return innerDiv
}

function listOnClickListener(innerContainer, option) {
  innerContainer
    .querySelectorAll('div.inner > ul.inner > li')
    .forEach((item) => {
      item.addEventListener('click', () => {
        innerContainer
          .querySelector('div.inner')
          .setAttribute('aria-expanded', false)
        innerContainer.classList.remove('show')
        innerContainer.previousElementSibling.setAttribute(
          'aria-expanded',
          false
        )
        innerContainer.previousElementSibling.querySelector(
          '.filter-option .filter-option-inner .filter-option-inner-inner'
        ).textContent = item.textContent
        innerContainer.parentNode.classList.remove('show')

        const selected = option.data.find((d) => {
          return (
            item.querySelector('.dropdown-item .text').textContent === d.name
          )
        })

        innerContainer.parentNode.querySelector('select').value = selected.id

        option.callback()
      })
    })
}

async function change_state() {
  const xhr = new XMLHttpRequest()
  const countryId = document.getElementById('country_id').value

  const res = await fetch('./banned.json')
  const banned = await res.json()
  const cta = document.getElementById('cta')

  if (banned.countries.includes(+countryId)) {
    const contactBtn = document.createElement('a')
    const submitBtn = cta.querySelector('button[type=submit]')

    contactBtn.href = 'https://t.me/Gana_11?text=hello gana' // link ke telegram
    contactBtn.className = 'btn btn-primary mr-3'
    contactBtn.textContent = 'Please contact Gana!' // caption buttonnya

    submitBtn.setAttribute('disabled', true)

    cta.innerHTML = contactBtn.outerHTML
    cta.innerHTML += submitBtn.outerHTML

    return
  } else {
    const contactBtn = cta.querySelector('a')

    if (cta.contains(contactBtn)) contactBtn.remove()
  }

  xhr.open('GET', `ajax/ajax_get_state.php?country=${countryId}`, false)

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const container = document.getElementById('state')
      const innerContainer = container.querySelector(
        '.dropdown > div.dropdown-menu[role=combobox]'
      )
      const innerSelect = container.querySelector('#state_id')
      const states = JSON.parse(this.responseText)
      const template = createTemplate(states)

      innerSelect.innerHTML = states.map(
        ({ id, name }) => `<option value="${id}">${name}</div>`
      )
      innerContainer.innerHTML = template.outerHTML

      listOnClickListener(innerContainer, {
        callback: change_city,
        data: states,
      })
    }
  }

  xhr.send()
}

function change_city() {
  const xhr = new XMLHttpRequest()
  const stateId = document.getElementById('state_id').value

  xhr.open('GET', `ajax/ajax_get_city.php?state=${stateId}`, false)

  xhr.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const container = document.querySelector('#city')
      const innerContainer = container.querySelector(
        '.dropdown > div.dropdown-menu[role=combobox]'
      )
      const innerSelect = container.querySelector('#city_id')
      const cities = JSON.parse(this.responseText)
      const template = createTemplate(cities)

      innerSelect.innerHTML = cities.map(
        ({ id, name }) => `<option value="${id}">${name}</div>`
      )
      innerContainer.innerHTML = template.outerHTML

      listOnClickListener(innerContainer, {
        callback: () => {},
        data: cities,
      })
    }
  }

  xhr.send()
}
