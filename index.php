<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Парсинг сайта с помощью PHP Simple HTML DOM Parser</title>
</head>

<body>
  <form action="" method="POST">
    <label for="url">Введите url</label>
    <input type="text" name="url" id="url" value="https://24dvlp.com/test_page/" placeholder=" Например, http://site.com" />
    <button>Спарсить в json</button>
  </form>
  <div id="code"></div>
  <script>
    
    const button = document.querySelector('button');
    button.addEventListener('click', event => {
     
      event.preventDefault();
      const address = document.querySelector('#url').value
      postData('/request.php', {
        url: address
      }).then((response) => {
        document.querySelector('#code').innerHTML = JSON.stringify(response, null, 4);
      })
    });

    async function postData(url = '', data = {}) {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          "Content-type": "application/x-www-form-urlencoded;charset=UTF-8"
        },
        body: JSON.stringify(data) 
      });
     
      return await response.json(); 
    }
  </script>
  <style>
    #code {
      white-space: pre;
      font-family: monospace;
    }

    form {
      display: flex;
      max-width: 400px;
      width: 100%;
      margin: 25px auto;
      justify-content: center;
      align-items: flex-start;
      flex-direction: column;
    }

    form>* {
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    label {
      font-size: 18px;
      font-weight: bold;
    }

    input,
    button {
      display: block;
      width: 100%;
      padding: 5px 10px;
    }
  </style>
</body>

</html>