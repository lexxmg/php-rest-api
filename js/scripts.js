
'use strict';

const list = document.querySelector('.list');
const formSend = document.forms.formSend;

//const formData = new FormData(formSend);

//formData.append('name', 'test-formData');

getUsers();

formSend.addEventListener('submit', event => {
  event.preventDefault();

  fetch('http://php-rest.api?type=user', {
    method: 'POST',
    body: new FormData(formSend)
  })
    .then(res => res.json())
    .then(data => {
      if (data.status) {
        list.innerHTML = '';
        getUsers();
        console.log(data.user_id);
      } else {
        alert(data.message);
      }
    });
});

list.addEventListener('click', event => {
  if (event.target.dataset.id) {
    const id = event.target.dataset.id;
    fetch(`http://php-rest.api?type=user&id=${id}`, {
      method: 'DELETE'
    })
      .then(res => res.json())
      .then(data => {
        if (data.status) {
          list.innerHTML = '';
          getUsers();
          console.log(data.user_id);
        } else {
          alert(data.message);
        }
      });
  }
});


function getUsers() {
  fetch('http://php-rest.api?type=users')
    .then(res => res.json())
    .then(data => {
      if (data.length > 0) {
        data.forEach((item, i) => {
          list.insertAdjacentHTML('afterbegin',
            `
              <li class="list__item list-item">
                <p class="list-item__text">${item.name}</p>
                <p class="list-item__text">${item.data}</p>

                <button class="list-item__btn" data-id="${item.id}">удалить</button>
              </li>
            `
          );
        });
      }
    });
}


// fetch('http://php-rest.api', {
//     method: 'POST', // или 'PUT'
//     body: JSON.stringify(data), // данные могут быть 'строкой' или {объектом}!
//     headers: {
//       'Content-Type': 'application/json; charset=utf-8'
//     }
//   })
//   .then(res => res.text())
//   .then(data => console.log(data));
