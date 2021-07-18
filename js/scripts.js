
'use strict';

const data = [
  {
    name: 'test',
    id: 1
  },
  {
    name: 'test-2',
    id: 2
  }
];

const formData = new FormData();

formData.append('name', 'test-formData');

fetch('http://php-rest.api?type=user', {
  method: 'POST',
  body: formData
})
  .then(res => res.json())
  .then(data => {
    fetch(`http://php-rest.api?type=user&id=${data.user_id}`)
      .then(res => res.json())
      .then(data => console.log(data));
  });

// fetch('http://php-rest.api', {
//     method: 'POST', // или 'PUT'
//     body: JSON.stringify(data), // данные могут быть 'строкой' или {объектом}!
//     headers: {
//       'Content-Type': 'application/json; charset=utf-8'
//     }
//   })
//   .then(res => res.text())
//   .then(data => console.log(data));

fetch('http://php-rest.api?type=users')
  .then(res => res.json())
  .then(data => console.log(data));

fetch('http://php-rest.api?type=user&id=3')
  .then(res => res.json())
  .then(data => console.log(data));
