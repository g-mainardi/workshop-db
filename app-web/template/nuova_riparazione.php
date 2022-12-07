<section class="grande">
	<h2>Registra una riparazione</h2>
	<form action="#" method="POST">
		<ul>
			<li>				
				<label for="selezioneCliente"> Seleziona Cliente: </label>
				<?php if($SetParameters["selezionatoCliente"]): ?>
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
			
			<?php if($SetParameters["selezionatoCliente"]): ?>
			<li>				
				<label for="selezioneVeicolo"> Seleziona Veicolo: </label>
				<?php if($SetParameters["selezionatoVeicolo"]):?>
					<select name="selezioneVeicolo" required disabled>
					<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["cod_veicolo"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]?></option>
					<?php endforeach; ?>
				<?php else:?>
					<select name="selezioneVeicolo" required>
					<?php foreach($SetParameters["veicoli"] as $veicolo) :?>
						<option value=<?php echo $veicolo["cod_veicolo"]?>><?php echo $veicolo["casa_produttrice"]." - ".$veicolo["modello"]?></option>
					<?php endforeach; endif; ?>
				</select>
			</li>
			<?php endif; ?>

			<?php if($SetParameters["selezionatoVeicolo"]): $count=0;?>
			<li>
				<label for="selezioneMeccanici"> Seleziona i meccanici coinvolti: </label>
				<fieldset>
					<ul>
					<?php foreach($SetParameters["meccanici"] as $meccanico) : ?>
						<li>
							<input type="checkbox" id='<?php echo "meccanico".$count?>' name='<?php echo "meccanico".$count?>' value='<?php echo($meccanico["codice_fiscale"])?>'><label for=''><?php echo $meccanico["nome"]." ".$meccanico["cognome"]?></label>
						</li>
					<?php $count=$count+1; endforeach; ?>
					</ul>
				</fieldset>
			</li>
			<?php endif;?>


		</ul>		
		<input type="submit" name=<?php if($SetParameters["selezionatoVeicolo"]): echo "inserisciRiparazione"; else: echo "avanti"; endif?> value='<?php if($SetParameters["selezionatoVeicolo"]): echo "Inserisci riparazione";  else: echo "Avanti";endif;?>' >
	</form>

</section>

<section class="tabelle">
	<h2>Riparazioni registrate</h2>
	<table>
		<thead>
			<tr>
				<th>MECCANICI</th><th>CLIENTE</th><th>VEICOLO</th><th>DATA</th><th>TIPO</th><th>PREZZO</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($SetParameters["riparazioni"] as $riparazione) :?>
				<tr class="noform">
					<td><?php echo $riparazione["CF_meccanico"]; ?></td>
					<td><?php echo $riparazione["CF_cliente"]; ?></td>
					<td><?php echo $riparazione["cod_veicolo"]; ?></td>
					<td><?php echo $riparazione["data_riparazione"]; ?></td>
					<td><?php echo $riparazione["tipologia"]; ?></td>
					<td><?php echo $riparazione["prezzo"]; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
