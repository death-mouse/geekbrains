// $.post({
// 	url: '/action.php?id=1',
// 	data: {a: 1}
// });

//Функция AJAX авторизации
function login() {
	//Получаем input'ы логина и пароля
	const $login_input = $('[name="login"]');
	const $password_input = $('[name="password"]');

	//Получаем значение login и password
	const login = $login_input.val();
	const password = $password_input.val();

	//Инициализируем поле для сообщений
	const $message_field = $('.message');

	//Вызываем функцию jQuery AJAX с методом POST
	//Передаем туда url где будет обрабатваться API
	//И data которое будет помещена в $_POST
	//success - вызывается при успешном ответе от сервера

	$.post({
		url: '/api.php',
		data: {
			apiMethod: 'login',
			postData: {
				login: login,
				password: password
			}
		},
		success: function (data) {
			//data приходят те данные, который прислал на сервер


			//Вариант с json
			// if(data.error) {
			// 	$message_field.text(data.error_text);
			// } else {
			// 	location.reload();
			// }

			//Вариан без json
			if (data === 'OK') {
				location.reload();
			} else {
				$message_field.text(data);
			}
		}
	});
}

function addToCart(id) {
	//Инициализируем поле для сообщений
	const $message_field = $('.message');

	$.post({
		url: '/api.php',
		data: {
			apiMethod: 'addToCart',
			postData: {
				id: id
			}
		},
		success: function (data) {
			if(data === 'OK') {
				$message_field.text('Товар добавлен в корзину');
			} else {
				$message_field.text(data);
			}
			setTimeout(function () {
				$message_field.text('');
			}, 1000);
		}
	})
}

function removeFromCart(id) {
	$.post({
		url: '/api.php',
		data: {
			apiMethod: 'removeFromCart',
			postData: {
				id: id
			}
		},
		success: function (data) {
			if(data === 'OK') {
				$('[data-id="' + id + '"]').remove();
			} else {
				alert(data);
			}
		}
	})
}

function removeOrder(id) {
	$.post({
		url: '/api.php',
		data: {
			apiMethod: 'removeOrder',
			postData: {
				id: id
			}
		},
		success: function (data) {
			if(data === 'OK') {
				$('[data-id="' + id + '"]').remove();
			} else {
				alert(data);
			}
		}
	})
}

function setStatusOrder(id, statusId) {
	$.post({
		url: '/api.php',
		data: {
			apiMethod: 'setStatusOrder',
			postData: {
				id: id,
				statusId : statusId
			}
		},
		success: function (data) {
			if(data === 'OK') {
				var statusText = "Статус заказ: Заказ создан";
				if(statusId === 2){
					statusText = "Статус заказ: Заказ отменен";
				}
				if(statusId === 3){
					statusText = "Статус заказ: Заказ плачен";
				}
				if(statusId === 4){
					statusText = "Статус заказ: Заказ доставлен";
				}
				$('[data-id="' + id + 'status"]').text(statusText);
			} else {
				alert(data);
			}
		}
	})
}
