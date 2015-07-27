<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<i>execution time: <?php echo $this->endTime - $this->startTime . ' ms'; ?></i>
</body>
</html>
