		<footer>
			&copy; <?php echo date('Y'); ?> FitEvoMN
		</footer>

		<script src="<?php echo url_for('/public/js/jquery-1.11.3.min.js'); ?>"></script>
		<script src="<?php echo url_for('/public/js/tether.min.js'); ?>"></script>
		<script src="<?php echo url_for('/public/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo url_for('/public/js/formError.js'); ?>"></script>
	</body>
</html>

<?php db_disconnect($db); ?>