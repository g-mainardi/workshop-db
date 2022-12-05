<section class="grande">
	<h2>Registra un pezzo</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="pezzoCasaProd"> Casa di Produzione: </label>
				<input type="text" name="pezzoCasaProd" placeholder="Casa di Produzione" maxlength="16" required>
			</li>
			<li>				
				<label for="pezzoModello"> Modello: </label>
				<input type="text" name="pezzoModello" placeholder="Modello" maxlength="20" required>
			</li>
			<li>				
				<label for="pezzoDescrizione"> Descrizione: </label>
				<textarea name="pezzoDescrizione" id="" cols="30" rows="10" placeholder="Descrizione del pezzo di ricambio, dettagli, ecc." required></textarea>
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
				<th>CASA PRODUZIONE</th><th>MODELLO</th><th>DESCRIZIONE</th><th>COSTO UNITARIO</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["pezzi"] as $pezzo) :?>
				<tr class="noform">
					<td><?php echo $pezzo["casa_produttrice"]; ?></td>
					<td><?php echo $pezzo["modello"]; ?></td>
					<td><?php echo $pezzo["descrizione"]; ?></td>
					<td><?php echo $pezzo["costo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
