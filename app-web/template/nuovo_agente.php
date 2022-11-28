<section>
	<h2>Registra un agente</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="agenteCF"> Codice fiscale: </label>
				<input type="text" name="agenteCF" placeholder="Codice fiscale" maxlength="16" required>
			</li>
			<li>				
				<label for="agenteNome"> Nome: </label>
				<input type="text" name="agenteNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>
				<label for="agenteCognome"> Cognome: </label>
				<input type="text" name="agenteCognome" placeholder="Cognome" maxlength="20" required>
			</li>
			<li>				
				<label for="agenteDataNascita"> Data di nascita: </label>
				<input type="date" name="agenteDataNascita" required>
			</li>
			<li>				
				<label for="agenteTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="agenteTelefono" placeholder="Telefono" required>
			</li>
			<li>				
				<label for="agenteMail"> Email(opzionale): </label>
				<input type="email" name="agenteMail" placeholder="Email" maxlength="80">
			</li>
			<li>				
				<label for="agentePaga"> Paga oraria: </label>
				<input type="number" min="1" name="agentePaga" placeholder="Paga oraria" required>
			</li>
		</ul>		
		<input type="submit" name="submit"  value="Inserisci agente">
	</form>

</section>

<section class="tabelle">
	<h2>Agenti registrati</h2>
	<p>È possibile modificare Telefono, Mail e Paga Oraria di un agente</p>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>DATA DI NASCITA</th><th>TELEFONO</th><th>MAIL</th><th>PAGA ORARIA</th><th>AGGIORNA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["agenti"] as $agente) :?>
			<form action="#" method="POST">
				<tr>
					<td><input type="hidden" name="agenteCF" value=<?php echo $agente["CF"]; ?>> <?php echo $agente["CF"]?></td>
					<td><input type="hidden" name="agenteNome" value=<?php echo $agente["nome"]; ?>> <?php echo $agente["nome"]?></td>
					<td><input type="hidden" name="agenteCognome" value=<?php echo $agente["cognome"]; ?>> <?php echo $agente["cognome"]?></td>
					<td><input type="hidden" name="agenteDataNascita" value=<?php echo $agente["data_nascita"]; ?>> <?php echo $agente["data_nascita"]?></td>
					<td><input type="tel" pattern="[0-9]{10}" maxlength="10" name="agenteTelefono" placeholder="Inserisci Telefono" value=<?php echo $agente["telefono"]?> required></td>
					<td><input type="email" maxlength="80" name="agenteMail" placeholder="Inserisci email" value=<?php echo $agente["mail"]?>></td>
					<td><input type="number" min="1" name="agentePaga" placeholder="Inserisci paga oraria" value=<?php echo $agente["paga"]?> required></td>
					<td> <input disabled type="submit" name="aggiornaTelefono" value="Aggiorna Telefono"> <input disabled type="submit" name="aggiornaMail" value="Aggiorna Mail"> <input disabled type="submit" name="aggiornaPaga" value="Aggiorna Paga"> <input disabled type="submit" name="aggiornaTutto" value="Aggiorna Tutto"> </td>
				</tr>
			</form>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
