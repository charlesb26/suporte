<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewort" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Popup</title>
</head>
<body>
<button>Clique aqui</button>

<div class="popup-wrapper">
	<div class="popup">
		<div class="popup-close">x</div>
		<div class="popup-content">
			<h2>Deselegante</h2>
			<p>O autor do popup foi o programador </p>
			<a class="popup-link" href="#">Saiba mais</a>
		</div>
	</div>
</div>
</body>
</html>

<script type="text/javascript">
	const button = document.querySelector('button')
	const popup = document.querySelector('.popup-wrapper')
	
	button.addEventListener('click', () => {
		popup.style.display = 'block'
		//console.log('clicou!')
	})

	popup.addEventListener('click', event => {
		
		const classNameOfClickedElement = event.target.classList[0]
		const classNames = ['popup-close', 'popup-wrapper', 'popup-link']
		const shouldClosePopup = classNames.some(className =>
			className === classNameOfClickedElement)

		if(shouldClosePopup){
			popup.style.display = 'none'
		}
		})
</script>