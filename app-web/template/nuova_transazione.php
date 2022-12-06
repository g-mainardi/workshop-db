<section class="grande">
	<h2>Registra una transazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="selezioneAgente"> Seleziona Agente: </label>
				<?php if($SetParameters["selezionati"]):?>
					<select name="selezioneAgente" required disabled>
					<?php foreach($SetParameters["agente"] as $agente) :?>
						<option value=<?php echo($agente["codice_fiscale"])?>><?php echo $agente["nome"]." ".$agente["cognome"]." - ".$agente["codice_fiscale"]?></option>
					<?php endforeach; ?>
				<?php else: ?>
					<select name="selezioneAgente" required>
					<?php foreach($SetParameters["agenti"] as $agente) :?>
						<option value=<?php echo $agente["codice_fiscale"]?>><?php echo $agente["nome"]." ".$agente["cognome"]." - ".$agente["codice_fiscale"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<?php if($SetParameters["selezionati"]): ?>
					<select name="selezioneCliente" required disabled>
					<?php foreach($SetParameters["cliente"] as $cliente) :?>
						<option value=<?php echo $cliente["codice_fiscale"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["codice_fiscale"]?></option>
					<?php endforeach; ?>				
				<?php else: ?>
					<select name="selezioneCliente" required>
					<?php foreach($SetParameters["clienti"] as $cliente) :?>
						<option value=<?php echo $cliente["codice_fiscale"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["codice_fiscale"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
			<li>
				<label for="selezioneTipo"> Seleziona il tipo di transazione: </label>
				<?php if($SetParameters["selezionati"]):?>
					<select name="selezioneTipo" required disabled>
						<option value=<?php echo $SetParameters["tipo"]; ?>><?php echo $SetParameters["tipo"]; ?></option>
				<?php else:?>
					<select name="selezioneTipo" required>
						<option value="acquisto">acquisto</option>
						<option value="vendita">vendita</option>
				<?php endif;?>
				</select>
			</li>
			<?php if($SetParameters["selezionati"]): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<select name="selezioneVeicolo" required>
				<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
					<option value=<?php echo $veicolo["cod_veicolo"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]?></option>
				<?php endforeach; ?>
				</select>
			</li>
			<li>
				<label for="selezionePrezzo"> Stabilisci il prezzo (€): </label>
				<input type="number" min="0" step="5" name="selezionePrezzo" placeholder="Prezzo" required>
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
					<td><?php echo $transazione["CF_agente"]; ?></td>
					<td><?php echo $transazione["CF_cliente"]; ?></td>
					<td><?php echo $transazione["cod_veicolo"]; ?></td>
					<td><?php echo $transazione["data_transazione"]; ?></td>
					<td><?php echo $transazione["tipologia"]; ?></td>
					<td><?php echo $transazione["prezzo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
