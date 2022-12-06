<section>
	<h2>Registra un veicolo</h2>
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
				<input type="number" min="1960" max="2022" name="veicoloAnnoProd" placeholder="Anno" required>
			</li>
			<li>				
				<label for="veicoloCilindrata"> Cilindrata: </label>
				<input type="number" maxlength="10" name="veicoloCilindrata" placeholder="Cilindrata" required>
			</li>
			<li>
				<label for="proprietario"> Proprietario del veicolo: </label>
				<select name="proprietarioVeicolo"> 
				<?php foreach($SetParameters["proprietari"] as $proprietario) :?>
					<option value="<?php echo $proprietario["codice_fiscale"]; ?>"><?php echo $proprietario["nome"]." ".$proprietario["cognome"]." - ".$proprietario["codice_fiscale"]; ?></option>
				<?php endforeach; ?>
				</select> 
			</li>
				<label for="dataAppropriazione"> Data di acquisizione: </label>
				<input type="date" maxlength="10" name="dataAppropriazione" placeholder="dataAppropriazione" required>
			<li>
			</li>
		</ul>		
		<input type="submit" name="submit"  value="Inserisci veicolo">
	</form>

</section>

<section class="tabelle">
	<h2>Veicoli registrati</h2>
	<table>
		<thead>
			<tr>
				<th>CASA PRODUZIONE</th><th>MODELLO</th><th>ANNO DI PRODUZIONE</th><th>CILINDRATA(CM3)</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
				<tr class="noform">
					<td><?php echo $veicolo["casa_produttrice"]; ?></td>
					<td><?php echo $veicolo["modello"]; ?></td>
					<td><?php echo $veicolo["data_produzione"]; ?></td>
					<td><?php echo $veicolo["cilindrata"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
