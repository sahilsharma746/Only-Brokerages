<style>
    /* Styling for the trading-history section */
#trading-history {
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-top: 20px;
}

/* Table Container Scrollable Area */
.trading-history-table-area {
    max-height: 400px; /* Adjust height as per your requirement */
    overflow-y: auto;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* Styling the table */
.trading-history-table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Arial', sans-serif;
    font-size: 14px;
}

/* Table Header Styling */
.trading-history-table thead {
    background-color: #007bff;
    color: white;
}

.trading-history-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid #ddd;
}

/* Table Body Styling */
.trading-history-table tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background-color 0.2s ease;
}

.trading-history-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.trading-history-table tbody tr:hover {
    background-color: #f0f8ff;
}

.trading-history-table td {
    padding: 12px 15px;
    color: #333;
}

/* Ensure the table fits well on smaller screens */
@media (max-width: 768px) {
    .trading-history-table th, .trading-history-table td {
        padding: 8px 10px;
    }

    .trading-history-table th {
        font-size: 12px;
    }

    .trading-history-table td {
        font-size: 12px;
    }

    .trading-history-table-area {
        max-height: 300px; /* Reduce height for smaller screens */
    }
}

</style>

<div id="trading-history" class="trading-history collapse">
   
    <div class="trading-history-table-area table-area scroll w-100">
        <table id="trading-history-table" class="trading-history-table w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created</th>
                    <th>Asset</th>
                    <th>Manual/Auto</th>
                    <th>Live Demo</th>
                    <th>Trade</th>
                    <th>Market</th>
                    <th>PNL</th>
                    <th>Win/Loss</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trades as $trade)
                <tr>
                    <td>{{ $trade->id }}</td>
                    <td>{{ $trade->created_at->format('d-m-y') }}</td>
                    <td>
                        {{ $trade->asset }}
                    </td>
                    <td>Manual</td>
                    <td>{{ $trade->trade_type }}</td>
                    <td>${{$trade->capital }}</td>
                    <td>Currency</td>
                    <td>{{$trade->pnl}}</td>
                    <td>{{ $trade->trade_result }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
