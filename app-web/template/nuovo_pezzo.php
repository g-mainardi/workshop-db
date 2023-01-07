<section class="grande">
	<h2>Registra un pezzo</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="pezzoVeicolo"> Seleziona Veicolo: </label>
				<select name="pezzoVeicolo" required>
				<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
					<option value='<?php echo $db->getCarCod($veicolo["modello"], $veicolo["casa_produttrice"],$veicolo["anno_produzione"], $veicolo["cilindrata"], $veicolo["km_percorsi"]);?>'><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]." (".$veicolo["anno_produzione"].")"?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="pezzoNome"> Nome: </label>
				<input type="text" name="pezzoNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>		
				<label for="pezzoDescrizione"> Descrizione(opzionale): </label>
				<textarea name="pezzoDescrizione" id="" cols="30" rows="10" placeholder="Descrizione del pezzo di ricambio, dettagli, ecc."></textarea>
			</li>
			<li>
				<label for="pezzoCosto"> Costo unitario(€): </label>
				<input type="number" step="0.01" name="pezzoCosto" placeholder="Costo unitario" required>
			</li>
		</ul>		
		<input type="submit" name="inserisciPezzo"  value="Inserisci pezzo">
	</form>

</section>

<section class="tabelle">
	<h2>Pezzi registrati</h2>
	<table>
		<thead>
			<tr>
				<th>VEICOLO</th><th>NOME</th><th>DESCRIZIONE</th><th>COSTO UNITARIO</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["pezzi"] as $pezzo) :?>
				<tr class="noform">
					<td><?php echo $db->getVeicoloUsatoSpecifico($pezzo["cod_veicolo"]); ?></td>
					<td><?php echo $pezzo["nome"]; ?></td>
					<td><?php echo $pezzo["descrizione"]; ?></td>
					<td><?php echo $pezzo["costo_unitario"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
