<section>
	<h2>Registra un agente</h2>
	<form action="#" method="POST">
		<ul>
			<li>
				<label for="agenteCF"> Codice fiscale: </label>
				<input type="text" name="agenteCF" placeholder="Codice fiscale" maxlength="16" required>
			</li>
			<li>				
				<label for="agenteNome"> Nome: </label>
				<input type="text" name="agenteNome" placeholder="Nome" maxlength="20" required>
			</li>
			<li>
				<label for="agenteCognome"> Cognome: </label>
				<input type="text" name="agenteCognome" placeholder="Cognome" maxlength="20" required>
			</li>
			<li>				
				<label for="agenteTelefono"> Telefono: </label>
				<input type="tel" pattern="[0-9]{10}" maxlength="10" name="agenteTelefono" placeholder="Telefono">
			</li>
			<li>				
				<label for="agenteDataNascita"> Data di nascita: </label>
				<input type="date" name="agenteDataNascita">
			</li>
			<li>				
				<label for="agenteMail"> Email: </label>
				<input type="email" name="agenteMail" placeholder="Email" maxlength="80">
			</li>
		</ul>		
		<input type="submit" name="submit"  value="Inserisci agente">
	</form>

</section>

<section class="tabelle">
	<h2>Agenti registrati</h2>
	<table>
		<thead>
			<tr>
				<th>CF</th><th>NOME</th><th>COGNOME</th><th>TELEFONO</th><th>DATA DI NASCITA</th><th>MAIL</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($SetParameters["agenti"] as $agente) :?>
			<tr>
				<td><?php echo $agente["CF"]?></td><td><?php echo $agente["nome"]?></td><td><?php echo $agente["cognome"]?></td><td><?php echo $agente["telefono"]?></td>
				<td><?php echo $agente["data_nascita"]?></td><td><?php echo $agente["mail"]?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>
