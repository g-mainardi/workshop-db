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
		</ul>		
		<input type="submit" name="submit"  value="Inserisci veicolo">
	</form>

</section>

<section class="tabelle">
	<h2>Veicoli registrati</h2>
	<table>
		<thead>
			<tr>
				<th>CASA PRODUZIONE</th><th>MODELLO</th><th>ANNO DI PRODUZIONE</th><th>CILINDRATA(CM3)</th><th>PROPRIETARIO</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
				<tr class="noform">
					<td><?php echo $veicolo["casaProd"]; ?></td>
					<td><?php echo $veicolo["modello"]; ?></td>
					<td><?php echo $veicolo["anno_prod"]; ?></td>
					<td><?php echo $veicolo["cilindrata"]; ?></td>
					<td><?php echo $veicolo["proprietario"]?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
