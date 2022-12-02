<section class="grande">
	<h2>Registra una transazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="selezioneAgente"> Seleziona Agente: </label>
					<select name="selezioneAgente" required <?php if($SetParameters["selezionati"]): echo "disabled"; endif; ?>>
					<?php foreach($SetParameters["agenti"] as $agente) :?>
						<option value=<?php echo $agente["codice_fiscale"]?>><?php echo $agente["nome"]." ".$agente["cognome"]." - ".$agente["codice_fiscale"]?></option>
					<?php endforeach; ?>
					</select>
			</li>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<select name="selezioneCliente" required <?php if($SetParameters["selezionati"]): echo "disabled"; endif; ?>>
				<?php foreach($SetParameters["clienti"] as $cliente) :?>
					<option value=<?php echo $cliente["codice_fiscale"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["codice_fiscale"]?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="selezioneTipo"> Seleziona il tipo di transazione: </label>
				<select name="selezioneTipo" required <?php if($SetParameters["selezionati"]): echo "disabled"; endif; ?>>
					<option value="acquisto">Acquisto</option>
					<option value="vendita">Vendita</option>
				</select>
			</li>
			<?php if($SetParameters["selezionati"]): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<select name="selezioneVeicolo" required>
				<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
					<option value=<?php echo $veicolo["modello"]?>><?php echo $veicolo["casaProd"]." - ".$veicolo["modello"]?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="selezionePrezzo"> Stabilisci il prezzo: </label>
				<input type="number" min="0" name="selezionePrezzo" placeholder="Prezzo" required>
			</li>
			<?php endif; ?>
		</ul>		
		<input type="submit" name=<?php if($SetParameters["selezionati"]): echo "inserisciTransazione"; else: echo "avanti"; endif?> value=<?php if($SetParameters["selezionati"]): echo "Inserisci transazione"; else: echo "Avanti"; endif?> >
	</form>

</section>

<section class="tabelle">
	<h2>Transazioni registrate</h2>
	<table>
		<thead>
			<tr>
				<th>AGENTE</th><th>CLIENTE</th><th>VEICOLO</th><th>DATA</th><th>TIPO</th><th>PREZZO</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($SetParameters["transazioni"] as $transazione) :?>
				<tr class="noform">
					<td><?php echo $transazione["agente"]; ?></td>
					<td><?php echo $transazione["cliente"]; ?></td>
					<td><?php echo $transazione["veicolo"]; ?></td>
					<td><?php echo $transazione["data_transazione"]; ?></td>
					<td><?php echo $transazione["tipo"]; ?></td>
					<td><?php echo $transazione["prezzo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
