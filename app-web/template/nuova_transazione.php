<section class="grande">
	<h2>Registra una transazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="selezioneAgente"> Seleziona Agente: </label>
				<?php if (isset($SetParameters["selezionati"])):?>
					<select name="selezioneAgente" required disabled>
					<?php foreach($SetParameters["agente"] as $agente) :?>
						<option value=<?php echo($agente["CF_agente"])?>><?php echo $agente["nome"]." ".$agente["cognome"]." - ".$agente["CF_agente"]?></option>
					<?php endforeach; ?>
				<?php else: ?>
					<select name="selezioneAgente" required>
					<?php foreach($SetParameters["agenti"] as $agente) :?>
						<option value=<?php echo $agente["CF_agente"]?>><?php echo $agente["nome"]." ".$agente["cognome"]." - ".$agente["CF_agente"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<?php if(isset($SetParameters["selezionati"])): ?>
					<select name="selezioneCliente" required disabled>
					<?php foreach($SetParameters["cliente"] as $cliente) :?>
						<option value=<?php echo $cliente["CF_cliente"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["CF_cliente"]?></option>
					<?php endforeach; ?>				
				<?php else: ?>
					<select name="selezioneCliente" required>
					<?php foreach($SetParameters["clienti"] as $cliente) :?>
						<option value=<?php echo $cliente["CF_cliente"]?>><?php echo $cliente["nome"]." ".$cliente["cognome"]." - ".$cliente["CF_cliente"]?></option>
					<?php endforeach; ?>
				<?php endif;?>
				</select>
			</li>
			<li>
				<label for="selezioneTipo"> Seleziona il tipo di transazione: </label>
				<?php if(isset($SetParameters["selezionati"])):?>
					<select name="selezioneTipo" required disabled>
						<option value=<?php echo $SetParameters["tipo"]; ?>><?php echo $SetParameters["tipo"]; ?></option>
				<?php else:?>
					<select name="selezioneTipo" required>
						<option value="acquisto">acquisto</option>
						<option value="vendita">vendita</option>
				<?php endif;?>
				</select>
			</li>
			<li>
				<label for="selezioneTipoVeicolo"> Seleziona il tipo di transazione: </label>
				<?php if(isset($SetParameters["selezionati"])):?>
					<select name="selezioneTipoVeicolo" required disabled>
						<option value=<?php echo $SetParameters["tipoVeicolo"]; ?>><?php echo $SetParameters["tipoVeicolo"]; ?></option>
				<?php else:?>
					<select name="selezioneTipoVeicolo" required>
						<option value="nuovo">nuovo</option>
						<option value="usato">usato</option>
				<?php endif;?>
				</select>
			</li>
			<?php if(isset($SetParameters["selezionati"])): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<select name="selezioneVeicolo" required>
				<?php if($SetParameters["tipoVeicolo"]=="usato"): ?>
					<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["cod_veicolo_usato"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]." (".$veicolo["anno_produzione"].")"?></option>
					<?php endforeach; ?>
				<?php else: ?>
					<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["cod_veicolo_nuovo"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]." (".$veicolo["anno_produzione"].")"?></option>
					<?php endforeach; ?>
				<?php endif; ?>
				</select>
			</li>
			<li>
				<label for="selezionePrezzo"> Stabilisci il prezzo (€): </label>
				<input type="number" min="0" step="5" name="selezionePrezzo" placeholder="Prezzo" required>
			</li>
			<?php endif; ?>
		</ul>		
		<input type="submit" name=<?php if(isset($SetParameters["selezionati"])): echo "inserisciTransazione";else: echo "avanti"; endif?> value=<?php if(isset($SetParameters["selezionati"])): echo "Inserisci transazione";else: echo "Avanti"; endif?> >
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
					<td><?php echo $db->getVeicoloUsatoSpecifico($transazione["cod_veicolo"]); ?></td>
					<td><?php echo $transazione["data_transazione"]; ?></td>
					<td><?php echo $transazione["tipologia"]; ?></td>
					<td><?php echo $transazione["prezzo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
