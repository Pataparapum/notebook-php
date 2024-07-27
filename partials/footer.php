  </main>
  <?php $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH ) ?>
  <?php if ($uri == "/tarea_mastermind/" || $uri == "/tarea_mastermind/index.php"):  ?>
      <script src="/tarea_mastermind/static/js/welcome.js"></script>
  <?php endif ?>
</body>
</html>
