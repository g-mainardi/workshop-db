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
				<label for="agentePaga"> Paga oraria(minimo 1): </label>
				<input type="number" min="1" name="agentePaga" placeholder="Paga oraria" required>
			</li>
		</ul>		
		<input type="submit" name="inserisciAgente"  value="Inserisci agente">
	</form>
</section>
<section>
	<h2>Cerca l'agente del mese</h2>
	<?php if(isset($agenteDelMese)):?>
		<table class="singola">
			<thead>
				<tr>
					<th>L'agente che ha fatto più vendite in <?php echo $db->getmonthName($mese)." ".$anno." è ";?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
					<?php echo $agenteDelMese["nome"]." ".$agenteDelMese["cognome"]." (".$agenteDelMese["CF_agente"].")"?>  
					</td>
				</tr>
			</tbody>
		</table>
	<p>
		<br>
	</p>
	<?php else:?>
	<p>Ottieni l'agente che ha fatto più vendite nel periodo selezionato</p>
	<form action="#" method="POST">
		<label for="periodo"> Periodo da ricercare: </label>
		<input type="month" name="periodo" required>
		<input type="submit" name="ricercaAgente"  value="Cerca agente del mese">
	</form>
	<?php endif;?>
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
					<td><input type="hidden" id='<?php echo $agente["CF_agente"];?>' name="agenteCF" value=<?php echo $agente["CF_agente"]; ?>> <?php echo $agente["CF_agente"]?></td>
					<td><input type="hidden" id='<?php echo $agente["CF_agente"];?>' name="agenteNome" value=<?php echo $agente["nome"]; ?>> <?php echo $agente["nome"]?></td>
					<td><input type="hidden" id='<?php echo $agente["CF_agente"];?>' name="agenteCognome" value=<?php echo $agente["cognome"]; ?>> <?php echo $agente["cognome"]?></td>
					<td><input type="hidden" id='<?php echo $agente["CF_agente"];?>' name="agenteDataNascita" value=<?php echo $agente["data_nascita"]; ?>> <?php echo $agente["data_nascita"]?></td>
					<td><input type="tel" id='<?php echo $agente["CF_agente"];?>' pattern="[0-9]{10}" maxlength="10" name="agenteTelefono" placeholder="Inserisci Telefono" value=<?php echo $agente["telefono"]?> required></td>
					<td><input type="email" id='<?php echo $agente["CF_agente"];?>' maxlength="80" name="agenteMail" placeholder="Inserisci email" value=<?php echo $agente["email"]?>></td>
					<td><input type="number" id='<?php echo $agente["CF_agente"];?>' min="1" name="agentePaga" placeholder="Inserisci paga oraria" value=<?php echo $agente["paga_oraria"]?> required></td>
					<td>
						<input disabled type="submit" id='<?php echo $agente["CF_agente"];?>' name="aggiornaTelefono" value="Aggiorna Telefono">
						<input disabled type="submit" id='<?php echo $agente["CF_agente"];?>' name="aggiornaMail" value="Aggiorna Mail">
						<input disabled type="submit" id='<?php echo $agente["CF_agente"];?>' name="aggiornaPaga" value="Aggiorna Paga">
						<input disabled type="submit" id='<?php echo $agente["CF_agente"];?>' name="aggiornaTutto" value="Aggiorna Tutto">
					</td>
				</tr>
			</form>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
