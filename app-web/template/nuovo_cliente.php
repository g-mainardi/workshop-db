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
				<label for="clienteDataNascita"> Data di nascita: </label>
				<input type="date" name="clienteDataNascita" required>
			</li>
			<li>				
				<label for="clienteTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="clienteTelefono" placeholder="Telefono" required>
			</li>
			<li>				
				<label for="clienteMail"> Email(opzionale): </label>
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
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>DATA DI NASCITA</th><th>TELEFONO</th><th>MAIL</th><th>AGGIORNA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["clienti"] as $cliente) :?>
			<form action="#" method="POST">
				<tr>
					<td><input type="hidden" name="clienteCF" value=<?php echo $cliente["CF"]; ?>> <?php echo $cliente["CF"]?></td>
					<td><input type="hidden" name="clienteNome" value=<?php echo $cliente["nome"]; ?>> <?php echo $cliente["nome"]?></td>
					<td><input type="hidden" name="clienteCognome" value=<?php echo $cliente["cognome"]; ?>> <?php echo $cliente["cognome"]?></td>
					<td><input type="hidden" name="clienteDataNascita" value=<?php echo $cliente["data_nascita"]; ?>> <?php echo $cliente["data_nascita"]?></td>
					<td><input type="tel" pattern="[0-9]{10}" maxlength="10" name="clienteTelefono" placeholder="Inserisci Telefono" value=<?php echo $cliente["telefono"]?> required></td>
					<td><input type="email" maxlength="80" name="clienteMail" placeholder="Inserisci email" value=<?php echo $cliente["mail"]?>></td>
					<td><input type="submit" name="aggiornaTelefono" value="Aggiorna Telefono"> <input type="submit" name="aggiornaMail" value="Aggiorna Mail"></td>
				</tr>
			</form>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>