package socketIo;

import jakarta.websocket.*;
import jakarta.websocket.server.ServerEndpoint;
import java.util.Map;
import java.util.Set;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.CopyOnWriteArraySet;

@ServerEndpoint("/bus")
public class BusServer {

    private static Set<Session> clients = new CopyOnWriteArraySet<>();
    private static Map<String, String> buses = new ConcurrentHashMap<>();

    @OnOpen
    public void onOpen(Session session) {
        clients.add(session);
        System.out.println("Client connected: " + session.getId());

        for (String message : buses.values()) {
            try {
                session.getBasicRemote().sendText(message);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    @OnMessage
    public void onMessage(String message, Session sender) {

        if (message == null || message.trim().isEmpty()) {
            return;
        }

        System.out.println("Received: " + message);

        try {
            String busId = message.split("\"busId\":\"")[1].split("\"")[0];

            buses.put(busId, message);

            for (Session session : clients) {
                try {
                    session.getBasicRemote().sendText(message);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

        } catch (Exception e) {
            System.out.println("Invalid message: " + message);
        }
    }

    @OnClose
    public void onClose(Session session) {
        clients.remove(session);
        System.out.println("Client disconnected: " + session.getId());
    }
}