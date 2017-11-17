<DOCTYPE html>
<html>
<head>

	<style type="text/css">
		html, body {
			font-size: 13px;
		}

		.container-fluid {
			border: 1px solid black;
		    padding: 15px;
		}

		.text-success {
			color: #90EE90;
		}

		.company-info {
			text-decoration: underline;
			text-transform: uppercase;
		}

		.report-info {
			font-weight: bold;
			text-align: right;
		}

		table {
		    border-collapse: collapse;
		    width: 100%;
		}

		table, th, td {
		    border: 1px solid black;
		    padding: 15px;
    		/*text-align: left;*/
		}

		th {
		    height: 50px;
		    background-color: #87CEEB;
		}

		.total {
			background: #90EE90;
			font-weight: bold;
		}


		.total-row {
			font-weight: bold;
			text-align: right;
		}

		.generateReportForm {
			text-align: center;
		}

		.generate-report-btn {
		 	background-color: #4CAF50; /* Green */
		    border: none;
		    color: white;
		    padding: 10px 24px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 12px;
		    border-radius: 8px;
		}
		
		.footer {
			text-align: center;
			font-weight: bold;
		}
	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="report-info" >
			<h4 class="company-info">
				@if(!empty($clientName))
                     {{ $clientName }}
                @endif
                's REPORT
			</h4>
			@if(!empty($fromDate))
                <p>From Date: {{ date('d, F, Y', strtotime($fromDate)) }}</p>
                <p>To Date  : {{ date('d, F, Y', strtotime($toDate)) }}</p>
            @endif
		</div>

		<hr>

		@if(!empty($allTransactionsFromClientCount))
		<h4>Transactions To And From {{ $clientName }}</h4>
		<table id="fromTable">
			<tr>
				<th>Source</th>
				<th>Destination</th>
				<th>Transactions</th>
				<th>Amount(KES)</th>
			</tr>
            @if(!empty($allTransactionsFromClientCount))
                @foreach($allTransactionsFromClientCount as $transactionsFromClient)
                    <tr>
                        <td>{{ $transactionsFromClient->source }}</td>
                        <td>{{ $transactionsFromClient->destination }}</td>
                        <td>{{ $transactionsFromClient->count }}</td>
                        <td class="from-amount">{{ number_format($transactionsFromClient->total,2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
					<td colspan="3">Transactions From {{ $clientName }} Total</td>
					<td class="from-total total">KSh. {{ $fromSum }}</td>
				</tr>
            @endif

            <tr>
				<th>Source</th>
				<th>Destination</th>
				<th>Transactions</th>
				<th>Amount(KES)</th>
			</tr>
            @if(!empty($allTransactionsToClientCount))
                @foreach($allTransactionsToClientCount as $transactionsToClient)
                    <tr>
                        <td>{{ $transactionsToClient->source }}</td>
                        <td>{{ $transactionsToClient->destination }}</td>
                        <td>{{ $transactionsToClient->count }}</td>
                        <td class="to-amount">{{ number_format($transactionsToClient->total,2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
					<td colspan="3">Transactions To {{ $clientName }} Total</td>
					<td class="to-total total">KSh. {{ $toSum }}</td>
				</tr>
            @endif

		</table>
		@endif

		@if(!empty($allTransactionsBetweenClientsCount))
		<h4>Transactions</h4>
		<table id="fromTable">
			<tr>
				<th>Source</th>
				<th>Destination</th>
				<th>Transactions</th>
				<th>Amount(KES)</th>
			</tr>
            @if(!empty($allTransactionsBetweenClientsCount))
                @foreach($allTransactionsBetweenClientsCount as $allTransactionsBetweenClientsCount)
                    <tr>
                        <td>{{ $allTransactionsBetweenClientsCount->source }}</td>
                        <td>{{ $allTransactionsBetweenClientsCount->destination }}</td>
                        <td>{{ $allTransactionsBetweenClientsCount->count }}</td>
                        <td class="from-amount">{{ number_format($allTransactionsBetweenClientsCount->total,2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
					<td colspan="3">Total</td>
					<td class="from-total total">KSh. {{ $fromSum }}</td>
				</tr>
            @endif
        </table>
        @endif

		<hr>

		<footer>
			<div class="footer">
				<p>Payment Gateway v2 &copy; 2017</p>
			</div>
		</footer>

	</div>
		
	
</body>
</html>

