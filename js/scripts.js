
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

fetch('http://php-rest.api', {
    method: 'POST', // или 'PUT'
    body: JSON.stringify(data), // данные могут быть 'строкой' или {объектом}!
    headers: {
      'Content-Type': 'application/json; charset=utf-8'
    }
  })
  .then(res => res.text())
  .then(data => console.log(data));

fetch('http://php-rest.api')
  .then(res => res.json())
  .then(data => console.log(data));
