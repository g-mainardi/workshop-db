<section>
	<h2>Registra un cliente</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="clienteCF"> Codice fiscale: </label>
				<input type="text" name="clienteCF" placeholder="Codice fiscale" maxlength="16" required>
			</li>
			<li>				
				<label for="clienteNome"> Nome: </label>
				<input type="text" name="clienteNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>
				<label for="clienteCognome"> Cognome: </label>
				<input type="text" name="clienteCognome" placeholder="Cognome" maxlength="20" required>
			</li>
			<li>				
				<label for="clienteTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="clienteTelefono" placeholder="Telefono">
			</li>
			<li>				
				<label for="clienteDataNascita"> Data di nascita: </label>
				<input type="date" name="clienteDataNascita">
			</li>
			<li>				
				<label for="clienteMail"> Email: </label>
				<input type="email" name="clienteMail" placeholder="Email" maxlength="80">
			</li>
		</ul>		
		<input type="submit" name="submit"  value="Inserisci cliente">
	</form>

</section>

<section class="tabelle">
	<h2>Clienti registrati</h2>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>TELEFONO</th><th>DATA DI NASCITA</th><th>MAIL</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["clienti"] as $cliente) :?>
			<tr>
				<td><?php echo $cliente["CF"]?></td><td><?php echo $cliente["nome"]?></td><td><?php echo $cliente["cognome"]?></td><td><?php echo $cliente["telefono"]?></td>
				<td><?php echo $cliente["data_nascita"]?></td><td><?php echo $cliente["mail"]?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
