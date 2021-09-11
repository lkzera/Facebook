<aside>
		<h2>Navegação</h2>
		<ul>
		<?php

		include_once "sessionControl.php";
		
		if ( is_session_started() === FALSE ) {
			session_start();
		}	
	    ?>
		</ul>
	</aside>

	<footer>
		
	</footer>

</body>

</html>