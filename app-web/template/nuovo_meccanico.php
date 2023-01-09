<section>
	<h2>Registra un meccanico</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="meccanicoCF"> Codice fiscale: </label>
				<input type="text" name="meccanicoCF" placeholder="Codice fiscale" maxlength="16" required>
			</li>
			<li>				
				<label for="meccanicoNome"> Nome: </label>
				<input type="text" name="meccanicoNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>
				<label for="meccanicoCognome"> Cognome: </label>
				<input type="text" name="meccanicoCognome" placeholder="Cognome" maxlength="20" required>
			</li>
			<li>				
				<label for="meccanicoDataNascita"> Data di nascita: </label>
				<input type="date" name="meccanicoDataNascita" required>
			</li>
			<li>				
				<label for="meccanicoTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="meccanicoTelefono" placeholder="Telefono" required>
			</li>
			<li>				
				<label for="meccanicoMail"> Email(opzionale): </label>
				<input type="email" name="meccanicoMail" placeholder="Email" maxlength="80">
			</li>
			<li>				
				<label for="meccanicoPaga"> Paga oraria(minimo 1): </label>
				<input type="number" min="1" name="meccanicoPaga" placeholder="Paga oraria" required>
			</li>
		</ul>		
		<input type="submit" name="inserisciMeccanico"  value="Inserisci meccanico">
	</form>
</section>

<?php if(isset($SetParameters["meccanici_migliori"])):?>
<section class="grande">
	<h2>Classifica dei 5 migliori meccanici dell'officina</h2>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>N°RIPARAZIONI</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["meccanici_migliori"] as $meccanico):?>
			<tr class="noform">
				<td><?php echo $meccanico["CF_meccanico"]?></td>
				<td><?php echo $meccanico["nome"]?></td>
				<td><?php echo $meccanico["cognome"]?></td>
				<td><?php echo $meccanico["n_riparazioni"]?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</section>
<?php endif;?>

<section class="tabelle">
	<h2>Meccanici registrati</h2>
	<p>È possibile modificare Telefono, Mail e Paga Oraria di un meccanico</p>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>DATA DI NASCITA</th><th>TELEFONO</th><th>MAIL</th><th>PAGA ORARIA</th><th>AGGIORNA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["meccanici"] as $meccanico) :?>
			<form action="#" method="POST">
				<tr>
					<td><input type="hidden" id='<?php echo $meccanico["CF_meccanico"];?>' name="meccanicoCF" value=<?php echo $meccanico["CF_meccanico"]; ?>> <?php echo $meccanico["CF_meccanico"]?></td>
					<td><input type="hidden" id='<?php echo $meccanico["CF_meccanico"];?>' name="meccanicoNome" value=<?php echo $meccanico["nome"]; ?>> <?php echo $meccanico["nome"]?></td>
					<td><input type="hidden" id='<?php echo $meccanico["CF_meccanico"];?>' name="meccanicoCognome" value=<?php echo $meccanico["cognome"]; ?>> <?php echo $meccanico["cognome"]?></td>
					<td><input type="hidden" id='<?php echo $meccanico["CF_meccanico"];?>' name="meccanicoDataNascita" value=<?php echo $meccanico["data_nascita"]; ?>> <?php echo $meccanico["data_nascita"]?></td>
					<td><input type="tel" id='<?php echo $meccanico["CF_meccanico"];?>' pattern="[0-9]{10}" maxlength="10" name="meccanicoTelefono" placeholder="Inserisci Telefono" value=<?php echo $meccanico["telefono"]?> required></td>
					<td><input type="email" id='<?php echo $meccanico["CF_meccanico"];?>' maxlength="80" name="meccanicoMail" placeholder="Inserisci email" value=<?php echo $meccanico["email"]?>></td>
					<td><input type="number" id='<?php echo $meccanico["CF_meccanico"];?>' min="1" name="meccanicoPaga" placeholder="Inserisci paga oraria" value=<?php echo $meccanico["paga_oraria"]?> required></td>
					<td>
						<input disabled type="submit" id='<?php echo $meccanico["CF_meccanico"];?>' name="aggiornaTelefono" value="Aggiorna Telefono">
						<input disabled type="submit" id='<?php echo $meccanico["CF_meccanico"];?>' name="aggiornaMail" value="Aggiorna Mail">
						<input disabled type="submit" id='<?php echo $meccanico["CF_meccanico"];?>' name="aggiornaPaga" value="Aggiorna Paga">
						<input disabled type="submit" id='<?php echo $meccanico["CF_meccanico"];?>' name="aggiornaTutto" value="Aggiorna Tutto">
					</td>
				</tr>
			</form>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
