<section>
	<h2>Registra una transazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="transazioneCF"> Codice fiscale: </label>
				<input type="text" name="transazioneCF" placeholder="Codice fiscale" maxlength="16" required>
			</li>
			<li>				
				<label for="transazioneNome"> Nome: </label>
				<input type="text" name="transazioneNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>
				<label for="transazioneCognome"> Cognome: </label>
				<input type="text" name="transazioneCognome" placeholder="Cognome" maxlength="20" required>
			</li>
			<li>				
				<label for="transazioneTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="transazioneTelefono" placeholder="Telefono">
			</li>
			<li>				
				<label for="transazioneDataNascita"> Data di nascita: </label>
				<input type="date" name="transazioneDataNascita">
			</li>
			<li>				
				<label for="transazioneMail"> Email: </label>
				<input type="email" name="transazioneMail" placeholder="Email" maxlength="80">
			</li>
		</ul>		
		<input type="submit" name="submit"  value="Inserisci transazione">
	</form>

</section>

<section class="tabelle">
	<h2>Transazioni registrate</h2>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>TELEFONO</th><th>DATA DI NASCITA</th><th>MAIL</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["transazioni"] as $transazione) :?>
			<tr>
				<td><?php echo $transazione["CF"]?></td><td><?php echo $transazione["nome"]?></td><td><?php echo $transazione["cognome"]?></td><td><?php echo $transazione["telefono"]?></td>
				<td><?php echo $transazione["data_nascita"]?></td><td><?php echo $transazione["mail"]?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
