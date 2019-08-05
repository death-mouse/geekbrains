<div data-id="{{ID}}">
	<h3>Заказ #{{ID}}</h3>
	<div data-id="{{ID}}status">Статус заказ: {{STATUS}}</div>
	<table class="cartTable"">
		<thead>
		<tr>
			<td>Название</td>
			<td>Стоимость</td>
			<td>Количество</td>
			<td>Сумма</td>
		</tr>
		</thead>
		<tbody>
		{{CONTENT}}
		<tr>
			<td colspan="3">Итого</td>
			<td>{{SUM}}</td>
		</tr>
		
		</tbody>
	</table>
	<span class="btn" onclick="removeOrder({{ID}})">Удалить</span>
	<span class="btn" onclick="setStatusOrder({{ID}}, 2)">Отменить зака</span>
	<span class="btn" onclick="setStatusOrder({{ID}}, 3)">Заказ оплачен</span>
	<span class="btn" onclick="setStatusOrder({{ID}}, 4)">Заказ Доставлен</span>
</div>

