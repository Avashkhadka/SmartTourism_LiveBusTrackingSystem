package socketIo;

import org.glassfish.tyrus.server.Server;

public class MainServar {

    public static void main(String[] args) {

        Server server = new Server("localhost", 8080, "/", null, BusServer.class);

        try {
            server.start();

            System.out.println("WebSocket running at ws://localhost:8080/bus");

            Thread.sleep(Long.MAX_VALUE);

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}