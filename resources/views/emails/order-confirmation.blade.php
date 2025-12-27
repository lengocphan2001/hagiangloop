<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">Order Confirmation</h1>
    </div>
    
    <div style="background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px;">
        <p style="font-size: 16px; margin-bottom: 20px;">Dear {{ $order->customer_name }},</p>
        
        <p style="font-size: 16px; margin-bottom: 20px;">
            Thank you for your booking! We have received your order and will process it shortly.
        </p>

        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h2 style="color: #ec4899; margin-top: 0; margin-bottom: 15px;">Order Details</h2>
            
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Order ID:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">#{{ $order->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Tour:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->tour->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Start Date:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->tour_start_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Adults:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->adults_count }}</td>
                </tr>
                @if($order->children_count > 0)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Children:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->children_count }}</td>
                </tr>
                @endif
                @if($order->outboundBusService)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Bus (Outbound):</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->outboundBusService->name }} - {{ number_format($order->outboundBusService->price, 0, ',', '.') }} VND</td>
                </tr>
                @endif
                @if($order->returnBusService)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Bus (Return):</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->returnBusService->name }} - {{ number_format($order->returnBusService->price, 0, ',', '.') }} VND</td>
                </tr>
                @endif
                @if($order->gift)
                <tr>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;"><strong>Gift:</strong></td>
                    <td style="padding: 8px 0; border-bottom: 1px solid #e5e7eb; text-align: right;">{{ $order->gift->name }}</td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 8px 0;"><strong style="font-size: 18px;">Total:</strong></td>
                    <td style="padding: 8px 0; text-align: right;"><strong style="font-size: 18px; color: #ec4899;">{{ number_format($order->total_price, 0, ',', '.') }} VND</strong></td>
                </tr>
            </table>
        </div>

        @if($order->notes)
        <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="color: #ec4899; margin-top: 0; margin-bottom: 10px;">Additional Notes:</h3>
            <p style="margin: 0;">{{ $order->notes }}</p>
        </div>
        @endif

        <p style="font-size: 16px; margin-bottom: 20px;">
            We will contact you soon to confirm your booking details. If you have any questions, please don't hesitate to contact us.
        </p>

        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <p style="margin: 0; color: #6b7280; font-size: 14px;">
                Best regards,<br>
                <strong>Hà Giang Loop Tours</strong>
            </p>
        </div>
    </div>
</body>
</html>

