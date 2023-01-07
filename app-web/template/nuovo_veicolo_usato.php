<section>
	<h2>Registra un veicolo usato</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="veicoloCasaProd"> Casa di Produzione: </label>
				<input type="text" name="veicoloCasaProd" placeholder="Casa di Produzione" maxlength="16" required>
			</li>
			<li>				
				<label for="veicoloModello"> Modello: </label>
				<input type="text" name="veicoloModello" placeholder="Modello" maxlength="20" required>
			</li>
			<li>				
				<label for="veicoloAnnoProd"> Anno di Produzione: </label>
				<input type="number" min="1900" max="2022"  step="1" name="veicoloAnnoProd" placeholder="Anno" required>
			</li>
			<li>				
				<label for="veicoloCilindrata"> Cilindrata(cm3): </label>
				<input type="number" maxlength="10" name="veicoloCilindrata" placeholder="Cilindrata" required>
			</li>
			<li>
				<label for="proprietario"> Proprietario del veicolo: </label>
				<select name="proprietarioVeicolo"> 
				<?php foreach($SetParameters["proprietari"] as $proprietario) :?>
					<option value="<?php echo $proprietario["CF_cliente"]; ?>"><?php echo $proprietario["nome"]." ".$proprietario["cognome"]." - ".$proprietario["CF_cliente"]; ?></option> 
				<?php endforeach; ?>
				</select> 
			</li>
			<li>
				<label for="dataAppropriazione"> Data acquisto veicolo: </label>
				<input type="date" name="dataAppropriazione" placeholder="dataAppropriazione" required>
			</li>
			<li>
				<label for="veicoloKmPercorsi">KM Percorsi</label>
				<input type="number" maxlength="10" name="veicoloKmPercorsi" placeholder="KM Percorsi" required>
			</li>
		</ul>		
		<input type="submit" name="inserisciVeicolo"  value="Inserisci veicolo">
	</form>

</section>

<section class="tabelle">
	<h2>Veicoli usati di proprietà dei clienti</h2>
	<table>
		<thead>
			<tr>
				<th>CASA PRODUZIONE</th><th>MODELLO</th><th>ANNO DI PRODUZIONE</th><th>CILINDRATA(CM3)</th><th>PROPRIETARIO</th><th>KM PERCORSI</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
				<tr class="noform">
					<td><?php echo $veicolo["casa_produttrice"]; ?></td>
					<td><?php echo $veicolo["modello"]; ?></td>
					<td><?php echo $veicolo["anno_produzione"]; ?></td>
					<td><?php echo $veicolo["cilindrata"]; ?></td>
					<td><?php echo $veicolo["nome_proprietario"]." ".$veicolo["cognome_proprietario"]." - ".$veicolo["CF_proprietario"]; ?></td>
					<td><?php echo $veicolo["km_percorsi"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<h2>Veicoli usati di proprietà dell'officina</h2>
	<table>
		<thead>
			<tr>
			<th>CASA PRODUZIONE</th><th>MODELLO</th><th>ANNO DI PRODUZIONE</th><th>CILINDRATA(CM3)</th><th>PROPRIETARIO</th><th>KM PERCORSI</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["veicoli_officina"] as $veicolo) :?>
				<tr class="noform">
					<td><?php echo $veicolo["casa_produttrice"]; ?></td>
					<td><?php echo $veicolo["modello"]; ?></td>
					<td><?php echo $veicolo["anno_produzione"]; ?></td>
					<td><?php echo $veicolo["cilindrata"]; ?></td>
					<td><?php echo $veicolo["nome_proprietario"]." ".$veicolo["cognome_proprietario"]." - ".$veicolo["CF_proprietario"]; ?></td>
					<td><?php echo $veicolo["km_percorsi"]; ?></td>
					<td><a href="gestione_transazioni.php">Acquista</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
