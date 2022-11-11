<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Experience day gift</title>
    <link rel="stylesheet" href="styles/main.css" />
  </head>
  <body>
    <script type="module" src="scripts/main.js"></script>

    <div id="content">
      <div class="loader"></div>

      <div id="gift-info" class="hidden">
        <form action="api/book.php">
          <input name="gift_id" value="" type="hidden">
          <select name="date"></select>
          <button type="submit">Book</button>
        </form>
      </div>
    </div>
  </body>
  <script type="module" src="scripts/gift.js"></script>
</html>
